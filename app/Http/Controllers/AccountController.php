<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\users;
use Illuminate\Http\Request;

class AccountController extends Controller
{   
    public function getAllUsers(){
        return users::all();
    } 

    public function getAllAccount(){
        return account::all();
    } 
    
    function transferMoney(Request $request){
        $data = $request->validate([
            'transferNumber' => 'string',
            'amountMoney' => 'string',
        ]);
        
        // get current user
        $absenders = users::where('remember_token', '=', $request->session()->get('_token'))->get();
        // logic transfer money 
        foreach($absenders as $absender){
            if($absender->phoneNumber != $data['transferNumber'])
            
                // account change cash
                foreach(users::where('phoneNumber', '=', $data['transferNumber'])->get() as $user){
                    // add money
                    foreach(account::where('user_id', '=', $user->id)->get() as $account){
                        if($account->cash >= $data['amountMoney']){
                            $account->cash += $data['amountMoney'];
                            $account->save();
                        }
                        else{
                            return view('transfer-money', ['message' => 'У вас недостаточно средств']);
                        }
                    }

                    // select money
                    foreach(account::where('user_id', '=', $absender->id)->get() as $account){
                        $account->cash -= $data['amountMoney'];
                        $account->save();
                    }
                }
            else{
                return view('transfer-money', ['message' => 'Это ваш Номер']);
            }
        }
        return redirect('/main');
    }

}
