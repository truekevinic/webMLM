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
    public function checkStatus(int $user_id){
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

                    $summary = new Summary();
                    $summary->user_id = $user->id;
                    $summary->status = "decrement";
                    $summary->text = $account[$arr]->upgrade_cost." for upgrade level to ".($arr+1);
                    $summary->save();

                    $grand = UserController::grandSearch($user->parent_id, $user->account_id);
                    $grandUser = User::find($grand);
                    $grandWallet = Wallet::where('user_id', '=', $grand)->where('wallet_type_id', '=', 3)->first();
                    $grandWallet->balance += $account[$arr]->upgrade_cost;
                    $grandUser->save();
                    $grandWallet->save();

                    $summary = new Summary();
                    $summary->user_id = $grand;
                    $summary->status = "increment";
                    $summary->text = $account[$arr]->upgrade_cost." from user with id ".$user->id." because of a level upgrade";
                    $summary->save();

                    $this->checkStatus($user->id);
                    $this->checkStatus($grandUser->id);
                }
            }
        }
    }

    public function grandSearch(int $id, int $level){
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

    public function child(int $id){
        $user = User::find($id);
        $children = User::where('parent_id', '=', $id)->get();
        return view('user.child', compact(['user', $user], ['children', $children]));
    }

    public function summary(int $id){
        $summaries = Summary::where('user_id', $id)->get();
//        dd($summaries);
        return view('user.summary', compact(['summaries', $summaries]));
    }
}
