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
        $sender = users::where('remember_token', $request->session()->token())->first();
        $recipient = users::where('phoneNumber', $data['transferNumber'])->first();
        // logic transfer money 
            if($sender->phoneNumber != $data['transferNumber']){

                // check isset recipient 
                if($recipient){

                    $senderAccount = $sender->account;
                    $recipientAccount = $recipient->account;

                    if($recipientAccount){
                        
                        // account change cash
                    
                        // add money
                            if($senderAccount->cash >= $data['amountMoney']){
                                $recipientAccount->cash += $data['amountMoney'];
                                $recipientAccount->save();
                                // select money
                                $senderAccount->cash -= $data['amountMoney'];
                                $senderAccount->save();
                            }
                            else{
                                return response()->json(['message' => 'У вас не достаточно средств']);
                            }
                        }

                    else{
                        return response()->json(['message' => 'Такого счета не существует']);
                    }
                }
                else{
                    return response()->json(['message' => 'Такого пользователя не существует']);
                }
            }
                    
            else{
                return response()->json(['message' => 'Вы не можете перевести сами себе']);
            }
        }
    }
