<?php

namespace App\Http\Controllers;

use App\Account;
use App\Package;
use App\Pairing;
use App\Rules\ChildMaxRule;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Summary;

class UserController extends Controller
{
    public function viewUpdateProfile(){

        $user = User::find(Auth::user()->id);
        $packages = Package::where('deleted',0)->get();
        return view('user.updateprofile',compact(['packages',$packages], ['user', $user]));
    }

    public function suspendControl($user_id){
        $user = User::find($user_id);

        if($user->suspend_status == 'suspend'){
            $user->suspend_status = 'unsuspend';
        }else{
            $user->suspend_status = 'suspend';
        }
         $user->save();

        return redirect()->back();
    }

    public function approveUser($user_id){
        $user = User::find($user_id);
        $user->role_status = 'approved';

        $referral_id = $user->referral_id;
        $uController = new UserController();

        $package = Package::find($user->package_id);
        $max_balance = $package->max_balance;
        $paid_balance = $package->package_cost;
        $max_withdraw = $package->max_withdraw;

        $childCount = User::where('parent_1','=',$referral_id)->count();

        $parent_1 = null;

        if ($childCount < 3) {
            $parent_1 = $referral_id;
            $parent_2 = (User::find($parent_1)->parent_1 == null ? 1 : User::find($parent_1)->parent_1);
            $parent_3 = (User::find($parent_1)->parent_2 == null ? 1 : User::find($parent_1)->parent_2);
            $parent_4 = (User::find($parent_1)->parent_3 == null ? 1 : User::find($parent_1)->parent_3);
            $parent_5 = (User::find($parent_1)->parent_4 == null ? 1 : User::find($parent_1)->parent_4);
            $parent_6 = (User::find($parent_1)->parent_5 == null ? 1 : User::find($parent_1)->parent_5);
            $parent_7 = (User::find($parent_1)->parent_6 == null ? 1 : User::find($parent_1)->parent_6);
            $parent_8 = (User::find($parent_1)->parent_7 == null ? 1 : User::find($parent_1)->parent_7);
            $active_status = 'active';

            $user->parent_1 = $parent_1;
            $user->parent_2 = $parent_2;
            $user->parent_3 = $parent_3;
            $user->parent_4 = $parent_4;
            $user->parent_5 = $parent_5;
            $user->parent_6 = $parent_6;
            $user->parent_7 = $parent_7;
            $user->parent_8 = $parent_8;

            $user->active_status = 'active';

            $uController->jackpot($parent_1, $user_id);
            $uController->checkStatusDirect((double)$paid_balance*0.2, $parent_1, $user_id);

            //add new wallet
            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 1, 'balance' => 0, 'max_balance' => $max_balance, 'max_withdraw' => (int)((double)$max_balance*$max_withdraw), 'level' => null]); //direct
            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 2, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //pairing
            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 3, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //jackpot
        }

        $user->save();

        return redirect()->back();
    }

    public function referralForm($referral_code) {
        $packages = Package::where('deleted',0)->get();
        return view('auth.register', compact(['packages', $packages]))->with('referral_code', $referral_code);
    }

    public function updateProfile(Request $request){
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->package_id = $request->package;

        if($request->old_password != ''){
            if($request->old_password == $user->password){
                $user->password == $request->password;
            }
        }

        if($request->hasFile('profile_image')){
            $picture_name = uniqid().$request->profile_image->getClientOriginalName();
            $request->profile_image->move(storage_path('app/public/images/'), $picture_name);

            $user->profile_image = $picture_name;
        }

        $user->save();

        return redirect()->to('/profile');
    }

    public function checkStatusJackpot($user_id){
        $user = User::find($user_id);
        $wallet = Wallet::where('user_id','=',$user_id)->where('wallet_type_id','=',3)->first();
        $account = Account::all();

        if ($wallet->level!=null){
            $arr = $wallet->level;
            if ($arr!=8){
                $referralWallet = Wallet::where('user_id', '=', $user->id)->where('wallet_type_id', '=', 3)->first();
                if ($referralWallet->balance >= $account[$arr]->upgrade_cost) {
                    $referralWallet->balance -= $account[$arr]->upgrade_cost;
                    $wallet->level += 1;
                    $wallet->save();
                    $referralWallet->save();

                    Summary::create(['user_id'=>$user->id, 'bonus_type_id'=>3, 'balance' => $account[$arr]->upgrade_cost, 'status'=>'decrement','text'=>$account[$arr]->upgrade_cost." for upgrade level to ".($arr+1)]);

                    $grand = $user['parent'.$wallet->level];
                    $grandUser = User::find($grand);
                    $grandWallet = Wallet::where('user_id', '=', $grand)->where('wallet_type_id', '=', 3)->first();
                    $grandWallet->balance += $account[$arr]->upgrade_cost;
                    $grandUser->save();
                    $grandWallet->save();

                    Summary::create(['user_id'=>$grand, 'bonus_type_id'=>3, 'balance' => $account[$arr]->upgrade_cost, 'status'=>'increment','text'=>$account[$arr]->upgrade_cost." from user with id ".$user->id." because of a level upgrade"]);

                    $this->checkStatusJackpot($user->id);
                    $this->checkStatusJackpot($grandUser->id);
                }
            }
        }
    }

    public function profile(){
        $user = Auth::user();
        $children = User::where('parent_1', '=', $user->id)->get();

        $wallet = Wallet::where('user_id', '=', $user->id)->sum('balance');

        return view('user.profile')->with('user', $user)->with('children', $children)->with('wallet', $wallet);
    }

    protected $idx = [];

    protected $childList = [];
    public function child($id){
        $user = User::find($id);
//        dd($user->child_users);
        $children = User::where('parent_1', '=', $id)->get();
        $this->childList = [];

        $unregisterUser = User::where('referral_id','=',$id)->where('active_status','=','pending')->get();

        $content = [
            'parent_1' => "",
            'user_id' => (string)$id,
            'user_name' => $user->username
        ];
//        array_push($this->childList, $content);
        $this->childFind($id);

//        dd($this->childList);

        return view('user.child', compact(['user', $user], ['children', $children], ['unregisterUser', $unregisterUser]))->with('childList', $this->childList)->with('user', $user)->with('html', $this->html($user, $children));
    }

    public function html ($parent, $child) {
        $field = '<div class="hv-item">';

        $len = count($child);
        $field .= '<div class='.($len == 0 ? "hv-item-child" : "hv-item-parent").'>
                        <div class="person '.strval($parent->id).'">
                            <img src="'.asset("storage/images/$parent->profile_image").'" alt="" width="50" height="50" />
                            <p class="name">'. $parent->name .'<b>/ '. $parent->id .'</b></p>
                        </div>
                    </div>';


        if ($len > 0) {
            $field .= '<div class="hv-item-children">';

            foreach ($child as $c) {
                $field .= '<div class="hv-item-child">';
                $field .= $this->html($c, $c->child_users);
                $field .= '</div>';
            }

            $field .= '</div>';
        }

        $field .= '</div>';
        return $field;
    }

    public function childFind($id){
        $childs = User::where('parent_1', '=', $id)->get();

        $childCount = count($childs);

        for ($i = 0; $i < $childCount; $i++) {
            $this->childFind($childs[$i]->id);
////            dd($childContent);
            $content = [
                'parent_1' => (string)$id,
                'user_id' => (string)$childs[$i]->id,
                'user_name' => $childs[$i]->username
            ];
            array_push($this->childList, $content);
        }
    }

    public function addMember(Request $request){
        $request->validate([
            'member_id' => ['required', 'exists:users,id'],
            'parent_1' => ['required', 'exists:wallets,user_id', new ChildMaxRule]
        ]);

        $parent_1 = $request->parent_1;
        $parent_2 = (User::find($parent_1)->parent_1 == null ? 1 : User::find($parent_1)->parent_1);
        $parent_3 = (User::find($parent_1)->parent_2 == null ? 1 : User::find($parent_1)->parent_2);
        $parent_4 = (User::find($parent_1)->parent_3 == null ? 1 : User::find($parent_1)->parent_3);
        $parent_5 = (User::find($parent_1)->parent_4 == null ? 1 : User::find($parent_1)->parent_4);
        $parent_6 = (User::find($parent_1)->parent_5 == null ? 1 : User::find($parent_1)->parent_5);
        $parent_7 = (User::find($parent_1)->parent_6 == null ? 1 : User::find($parent_1)->parent_6);
        $parent_8 = (User::find($parent_1)->parent_7 == null ? 1 : User::find($parent_1)->parent_7);
        $active_status = 'active';

        $user = User::find($request->member_id);
        $user->parent_1 = $parent_1;
        $user->parent_2 = $parent_2;
        $user->parent_3 = $parent_3;
        $user->parent_4 = $parent_4;
        $user->parent_5 = $parent_5;
        $user->parent_6 = $parent_6;
        $user->parent_7 = $parent_7;
        $user->parent_8 = $parent_8;
        $user->active_status = 'active';
        $user->save();

        $package = Package::find($user->package_id);

        $package_cost = $package->package_cost;
        $max_balance = $package->max_balance;
        $max_withdraw = $package->max_withdraw;

        $this->jackpot($parent_1, $user->id);
        $this->checkStatusDirect((double)$package->package_cost*0.2, (int)$parent_1, (int)$user->id);
//        return 'a';

        //add net wallet
        Wallet::create(['user_id' => $user->id, 'wallet_type_id' => 1, 'balance' => 0, 'max_balance' => $max_balance, 'max_withdraw' => (int)((double)$max_balance*$max_withdraw), 'level' => 1]); //direct
        Wallet::create(['user_id' => $user->id, 'wallet_type_id' => 2, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //pairing
        Wallet::create(['user_id' => $user->id, 'wallet_type_id' => 3, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //jackpot

        $bonusJackpotParent = User::find($user->id)->parent_1;
        if ($bonusJackpotParent != null) {
            $uController = new UserController();
            $uController->checkStatusJackpot($user->id);
        }

        return back();
    }

    public function manageUser(){

        $users = User::all();

        return view('user.manageuser', compact(['users', $users]));
    }

    public function summary($id){
        $summaries = Summary::where('user_id', $id)->get();
        return view('user.summary', compact(['summaries', $summaries]));
    }

    public function directView($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 1)->first();
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 1)->get();
        $packages = Package::where('deleted',0)->get();
        $user_package = Auth::user()->package_id;
        return view('user.wallet.direct', compact(['bonus', $bonus], ['summaries', $summaries], ['packages', $packages], ['user_package', $user_package]));
    }

    public function upgradePackage(Request $request){
        $user = Auth::user();
        $newPackage = Package::find($request->upgrade_package);

        $walletDirect = Wallet::where('user_id','=',$user->id)->where('wallet_type_id','=',1)->first();
        $walletDirect->balance -= $newPackage->package_cost;
//        $walletDirect->max_balance =
//        $walletDirect->max_withdraw =
    }

    public function jackpotView(int $id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 3)->first();
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 3)->get();
        return view('user.wallet.jackpot', compact(['bonus', $bonus], ['summaries', $summaries]));
    }

    public function pairingView($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 2)->first();
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 2)->get();

        $groupSale = $this->myGroupSales($id);

        return view('user.wallet.pairing', compact(['bonus', $bonus], ['summaries', $summaries]))->with('group_sale_list', $groupSale['group_sale_list'])->with('total_group_sale', $groupSale['total_group_sale']);
    }

    public function myGroupSales($id) {
        $members = User::where('parent_1', '=', $id)->get();
        $group_sale_list = [];
        $total_group_sale = 0;

        $wallet = Wallet::where('wallet_type_id', '=', 2)->where('user_id','=',$id)->first();

        foreach($members as $m) {
            $group_sale = (int)DB::table('users')->where('parent_1', '=', $m->id)->join('wallets', 'wallets.user_id', '=', 'users.id')->where('wallet_type_id', '=', 2)->sum('balance');

            $group_content = [
                'user_id' => $m->id,
                'user_name' => $m->name,
                'group_sale' => $group_sale
            ];

            $group_deposit = Pairing::find($wallet->level)->group_deposit;

            array_push($group_sale_list, $group_content);
            $total_group_sale += ($group_sale >= $group_deposit ? $group_deposit : $group_sale);
        }

        return ['group_sale_list' => $group_sale_list, 'total_group_sale' => $total_group_sale];
    }

    public function addDeposit(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $deposit = $request->deposit;

        $wallet = Wallet::where('user_id','=',$user_id)->where('wallet_type_id','=',2)->first();
        $wallet->balance += $deposit;
        $wallet->save();

        $parent_1 = $user->parent_1;
        if ($parent_1 != null) {
            $parent = User::find($parent_1);
            $grand = User::find($parent->parent_1);
            $groupSale = $this->myGroupSales($grand->id);

            $grand_wallet = Wallet::where('wallet_type_id', '=', 2)->where('user_id','=',$grand->id)->first();
            $grand_pairing = Pairing::find($grand_wallet->level);

            if ($grand_pairing != null) {
                $grand_group_deposit = $grand_pairing->group_deposit;
                $grand_prize = $grand_pairing->prize;

                if ($groupSale['total_group_sale'] >= $grand_group_deposit * 3) {
                    $level_up = $grand_wallet->level + 1;
                    $grand_wallet->level += 1;
                    $grand_wallet->save();
                    Summary::create(['user_id'=>$grand->id, 'bonus_type_id'=>2, 'balance' => 0, 'status'=>'increment','text'=>"Congratulation you have got $$grand_prize from your group deposit and now you are in level $level_up"]);
                }
            }
        }

        return back();
    }

    public function withdrawView(int $id){
        $wallets = Wallet::where('user_id', '=', $id)->get();
//        dd($wallets->walletTypes);
        return view('user.wallet.withdraw', compact(['wallets', $wallets], ['id', $id]));
    }

    public function withdraw(Request $request){
//        $wallet1 = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 1)->first();
//        $max_withdraw = $wallet1->max_withdraw;
//        if ($max_withdraw != null) {
//            $request->validate([
//                'wallet1' => "numeric|max:$max_withdraw"
//            ]);
//        }
//
//        if ($request->wallet1 > 0) {
//            $wallet1->balance -= $request->wallet1;
//            $wallet1->save();
//
//            $wallet1->max_withdraw -= $request->wallet1;
//
//            Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>1, 'balance' => $request->wallet1, 'status'=>'decrement','text'=>"$request->wallet1 after withdraw"]);
//        }

        if ($request->wallet2 > 0) {
            $wallets = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 2)->first();
            $wallets->balance -= $request->wallet2;
            $wallets->save();
            Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>2, 'balance' => $request->wallet2, 'status'=>'decrement','text'=>"$request->wallet2 after withdraw"]);
        }

        if ($request->wallet3 > 0) {
            $wallets = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 3)->first();
            $wallets->balance -= $request->wallet3;
            $wallets->save();
            Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>3, 'balance' => $request->wallet3, 'status'=>'decrement','text'=>"$request->wallet3 after withdraw"]);
        }

        return back();
    }

    public function viewPackage(){
        $packages = Package::where('deleted',0)->get();
        return view('user.package',compact(['packages',$packages]));
    }

    public function direct($balance, $referral_id, $user_id){
        $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 1)->first();
        $referralWallet->balance = $referralWallet->balance + (int)$balance;
        $referralWallet->save();

        Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>1, 'balance' => $balance,'status'=>'increment','text'=>"$balance from user with id $user_id because of a first registration"]);
    }

    public function checkStatusDirect($balance, $referral_id, $user_id){
        if ($balance > 0){
            if ($referral_id == 1) $this->direct($balance, $referral_id, $user_id);
            else {
                $totalBalance = Summary::where('user_id', '=', $referral_id)->where('status','=','increment')->where('bonus_type_id','=',1)->whereDate('created_at', '=', Carbon::today()->toDateString())->sum('balance');
                $wallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 1)->first();
                $maxBalance = $wallet->max_balance;

                $walletLeft = $maxBalance - $totalBalance;

                if ($walletLeft >= $balance) {
                    $this->direct($balance, $referral_id, $user_id);
                } else {
                    $this->direct($walletLeft, $referral_id, $user_id);
                    $parent_1 = User::find($referral_id)->parent_1;
                    $this->checkStatusDirect($balance - $walletLeft, $parent_1, $user_id);
                }
            }
        }
    }

    public function pairing($referral_id){
        $bonus = 0;
        $child = User::where('parent_1', '=', $referral_id)->count() + 1;
        if ($child == 20) $bonus = 500;
        else if ($child == 60) $bonus = 1000;
        else if ($child == 160) $bonus = 2000;
        else if ($child == 400) $bonus = 5000;
        else if ($child == 1000) $bonus = 10000;
        else if ($child == 2000000) $bonus = 20000;

        if ($bonus != 0) {
            $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 2)->first();
            $referralWallet->balance += $bonus;
            $referralWallet->save();

            Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>2, 'balance' => $bonus, 'status'=>'increment','text'=>"$bonus because you have got $child members!"]);
        }
    }

    public function jackpot($referral_id, $user_id){
        $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 3)->first();
        $referralWallet->balance += 30;
        $referralWallet->save();

        Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>3, 'balance' => 30, 'status'=>'increment','text'=>"30 from user with id $user_id because of a first registration"]);

        $this->checkStatusJackpot($referral_id);
    }
}
