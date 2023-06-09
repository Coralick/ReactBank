<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\loan;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function getAllUsers(){
        return users::all();
    } 

    // Show main list and get data for it
    public function showMain(Request $request)
    { 
        $token = $request->session()->get('_token');

        foreach(users::where('remember_token', '=', $token)->get() as $users){
            $user = $users;
        }
        if(isset($user)){
        // get Accounts 
            $accounts = account::where('user_id', $user->id)->get();   
            $loan = loan::where('user_id', $user->id)->get();   
            return view('main', ['user' => $user, 'accountList' => $accounts, 'loanList' => $loan]);
        }
        else {
            echo "Выйди от сюда, разбийник!!";
        }
    }



    public function checkUser(Request $request){
        $data = request()->validate([
            'email' => 'string',
            'password' => 'string',
        ]);

        // check for enter in system
        $request->session()->forget('message');
        foreach($this->getAllUsers() as $user){
            if($user->email == $data['email'] and $user->password === md5($data['password'])) {
                $request->session()->put('_token', $user->remember_token);
                return redirect()->route('mainList.show');
            }   
        }

        $request->session()->put('message', 'Неверный логин или пароль');
        return redirect()->route('users.index');
    }


    // register user
    public function registUser(Request $request){
        $isExise = true;
        $data = request()->validate([
            'name' => 'string',
            'lastname' => 'string',
            'phoneNumber' => 'string',
            'email' => 'string',
            'password' => 'string',
            'passwordRepeat' => 'string',            
        ]);

        $request->session()->forget('message');

        // check right data
        if($data['password'] === $data['passwordRepeat']){
            $data['password'] = md5($data['password']);
            foreach($this->getAllUsers() as $user){
                if($user->email === $data['email'] or $data['phoneNumber'] === $user->phoneNumber){
                    $isExise = false;
                    $request->session()->forget('message');
                }     
            }

            // register users
            if($isExise){

                $data['remember_token'] = hash('sha256', Str::random(80));

                users::create($data);
                return redirect()->route('users.index');

            }
            else{
                $request->session()->put('message', 'Этот логин не подходит');
                return redirect()->route('regist.index'); 
            }
        }
    }


    // test function 
    public function test(Request $request){
        session('_token', hash('sha256', Str::random(80)));
        $value = $request->session()->get('_token');
        print_r($value . '<br>');        
        print_r('8eQjXjNuwYNQjYsDJlRkUD30k72oIcOuGszYL3vp');
    }
}