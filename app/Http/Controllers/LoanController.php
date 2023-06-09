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

    public function getAllAccount(){
        return account::all();
    } 
    public function createLoan(Request $request){
        $data = request()->validate([
            'period' => 'string',
            'sum' => 'string',
            'user_id' => 'int',
        ]);

        // create loan logic
        if($data['sum'] >= 1000 and $data['sum'] <= 150000){
            foreach(users::where('remember_token', '=', $request->session()->get('_token'))->get() as $user){
                $data['user_id'] = $user->id;
                loan::create($data);
            }
            return redirect('/main');
        }
        else{
            return view('add-loan', ['message' => 'Вы ввели недопустимую сумму!']);
        }
    }
    public function closeLoan(Request $request, $loan_id){
        $data = request()->validate([
            'amountMoney' => 'integer',
        ]);
        dd($loan_id);
        // $token = $request->session()->get('_token');
        // foreach(users::where('remember_token', '=', $token) as $user){
        //     $id = $user->id;
        // }
        // if(isset($id)){
        //     foreach(account::where('user_id', '=', $id) as $account){
        //         $account->cash -= $data['amountMoney'];
        //     }
            
        // }

        // else{
        //     return view('close-loan', ['message' => 'Ты что тут забыл, разбийник !!!']);
        // }
    }
}

    