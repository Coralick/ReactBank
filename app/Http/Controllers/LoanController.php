<?php

namespace App\Http\Controllers;
use App\Models\loan;
use App\Models\users;
use App\Models\account;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    public function createLoan(Request $request){
        $data = request()->validate([
            'sum' => 'string',
        ]);

        // create loan logic
        if($data['sum'] >= 1000 and $data['sum'] <= 150000){
            $user = users::where('remember_token', $request->session()->token())->first();
            $data['users_id'] = $user->id; 
            $account = $user->account;
            $account->cash += $data['sum'];
            $account->save();
            loan::create($data);
            return response()->json();
        }
        else{
            return response()->json(['message' => 'Вы ввели недопустимую сумму']);
        }
    }


    public function closeLoan(Request $request){
        $data = request()->validate([
            'amountMoney' => 'string',
            'id' => 'integer',
        ]);
    // return response()->json($data);

        $loan = loan::find($data['id']);
        $user =  $user = users::where('id',$loan->users_id)->first();
        
        if(isset($user)){
            
            $account = $user->account;
        // money transfer
            if($account->cash > $data['amountMoney']){
                if($loan->sum - $data['amountMoney'] >= 0){
                    $account->cash -= $data['amountMoney'];
                    $loan->sum -= $data['amountMoney'];
                    $account->save();
                }
                else{
                    return response()->json(['message' => 'Вы ввели слишком большую сумму']);
                }
            }
            else{
                return response()->json(['message' => 'У вас не достаточно средств']);
            }
        // check repayment loan
            if($loan->sum > 0){
                $loan->save();
            }
            else{
                $loan->delete();
            }
            return response()->json();
        
        }
        else{
            return response()->json(['message' => 'Возникли технические шакаладки, обратитесь к администратору']);
        }
    }
}

    