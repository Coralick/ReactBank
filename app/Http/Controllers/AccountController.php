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
        $url = $request->session()->get('_previous')['url'];
        $absenders = users::where('remember_token', '=', $request->session()->get('_token'))->get();
        foreach($absenders as $absender){
            foreach($this->getAllUsers() as $user){
                if($user->phoneNumber === $data['transferNumber']){
                    // account change cash
                    foreach($this->getAllAccount() as $account){
                        if($account->user_id == $user->id){
                            $account->cash += $data['amountMoney'];
                            $account->save();
                        }

                        if($absender->id == $account->user_id){
                            $account->cash -= $data['amountMoney'];
                            $account->save();
                        }
                    }
                }
                
            }
        }
        return redirect('/main');
    }

}
