<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Summary;

class UserController extends Controller
{
    public function checkStatusJackpot($user_id){
        $user = User::find($user_id);
        $account = Account::all();

        if ($user->account_id!=null){
            $arr = $user->account_id;
            if ($arr!=8){
                $referralWallet = Wallet::where('user_id', '=', $user->id)->where('wallet_type_id', '=', 3)->first();
                if ($referralWallet->balance >= $account[$arr]->upgrade_cost) {
                    $referralWallet->balance -= $account[$arr]->upgrade_cost;
                    $user->account_id += 1;
                    $user->save();
                    $referralWallet->save();

                    Summary::create(['user_id'=>$user->id, 'bonus_type_id'=>3, 'status'=>'decrement','text'=>$account[$arr]->upgrade_cost." for upgrade level to ".($arr+1)]);

                    $grand = UserController::grandSearch($user->parent_id, $user->account_id);
                    $grandUser = User::find($grand);
                    $grandWallet = Wallet::where('user_id', '=', $grand)->where('wallet_type_id', '=', 3)->first();
                    $grandWallet->balance += $account[$arr]->upgrade_cost;
                    $grandUser->save();
                    $grandWallet->save();

                    Summary::create(['user_id'=>$grand, 'bonus_type_id'=>3, 'status'=>'increment','text'=>$account[$arr]->upgrade_cost." from user with id ".$user->id." because of a level upgrade"]);

                    $this->checkStatusJackpot($user->id);
                    $this->checkStatusJackpot($grandUser->id);
                }
            }
        }
    }

    public function grandSearch($id, $level){
        if ($level == 1) return $id;

        $parent = User::find($id);
        if ($parent->account_id == null) return 1;
        return $this->grandSearch($parent->parent_id, $level-1);
    }

    public function profile(){
        $user = Auth::user();
        $children = User::where('parent_id', '=', $user->id)->get();

        $wallet = Wallet::where('user_id', '=', $user->id)->sum('balance');

        return view('user.profile', compact(['user', $user], ['children', $children], ['wallet', $wallet]));
    }

    public function child($id){
        $user = User::find($id);
        $children = User::where('parent_id', '=', $id)->get();
        return view('user.child', compact(['user', $user], ['children', $children]));
    }

    public function summary($id){
        $summaries = Summary::where('user_id', $id)->get();
//        dd($summaries);
        return view('user.summary', compact(['summaries', $summaries]));
    }

    public function direct($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 1)->first();
        return view('user.wallet.direct', compact(['bonus', $bonus]));
    }

    public function jackpot(int $id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 3)->first();
        return view('user.wallet.jackpot', compact(['bonus', $bonus]));
    }

    public function pairing($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 2)->first();
        return view('user.wallet.pairing', compact(['bonus', $bonus]));
    }

    public function withdrawView($id){
        $wallets = Wallet::where('user_id', '=', $id)->get();
//        dd($wallets->walletTypes);
        return view('user.wallet.withdraw', compact(['wallets', $wallets]));
    }

    public function withdraw(Request $request){
        $balance = $request->total;
    }
}
