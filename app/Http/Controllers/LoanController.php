<?php

namespace App\Http\Controllers;
use App\Models\loan;
use App\Models\users;
use App\Models\account;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function getAllUsers(){
        return users::all();
    } 

    public function getAllAccounts(){
        return account::all();
    } 

    public function getAllLoans(){
        return loan::all();
    } 


    public function createLoan(Request $request){
        $data = request()->validate([
            'period' => 'int',
            'sum' => 'string',
        ]);

        // create loan logic
        if($data['sum'] >= 1000 and $data['sum'] <= 150000){
            foreach(users::where('remember_token', '=', $request->session()->get('_token'))->get() as $user){
                $data['user_id'] = $user->id;
                var_dump($data);
                loan::create($data);
            }
            return redirect('/main');
        }
        else{
            return view('add-loan', ['message' => 'Вы ввели недопустимую сумму']);
        }
    }


    public function closeLoan(Request $request){
        $data = request()->validate([
            'amountMoney' => 'integer',
            'id' => 'integer',
        ]);

        $token = $request->session()->get('_token');
        foreach(users::where('remember_token', '=', $token)->get() as $user){
            $id = $user->id;
        }
        
        if(isset($id)){

            foreach($this->getAllAccounts() as $account){

                if($account->user_id == $id){

                    // account logic
                    if($account->cash > $data['amountMoney']){
                        $account->cash -= $data['amountMoney'];
                        $account->save();
                    }
                    else{
                        return redirect('/close-loan');
                    }
                    // loans logic
                    foreach($this->getAllLoans() as $loan){
                        if($loan->id == $data['id']){
                            $loan->sum -= $data['amountMoney'];

                            // check repayment loan
                            if($loan->sum > 0){
                                $loan->save();
                            }

                            else{
                                $loan->delete();
                            }
                        }
                    }   
                }
            }

            return redirect('/main');
        }
        else{
            return view('error', ['message' => 'ты как сюда попал ?']);
        }
    }
}

    