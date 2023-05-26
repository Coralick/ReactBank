<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getAllUsers(){
        return users::all();
    } 

    public function showMain(Request $request)
    {   
        
        $token = $request->session()->get('_token');
        $user = '';
        foreach(users::where('remember_token', '=', $token)->get() as $users){
            $user = $users;
        }

        // get Accounts 
            $accounts = account::where('user_id', $user->id)->get();
            foreach($accounts as $account){
                $accounts = $account;
        }
        return view('main', ['user' => $user, 'account' => $accounts]);
    }

    // public function showView($path){
    //     return view($path);
    // }


    public function checkUser(Request $request){
        $data = request()->validate([
            'email' => 'string',
            'password' => 'string',
        ]);
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
        if($data['password'] === $data['passwordRepeat']){
            $data['password'] = md5($data['password']);
            foreach($this->getAllUsers() as $user){
                if($user->email === $data['email'] or $data['phoneNumber'] === $user->phoneNumber){
                    $isExise = false;
                    $request->session()->forget('message');
                }     
            }

            if($isExise){
                $data['remember_token'] = $user->remember_token;
                if($request->session()->get('_token') === $user->remember_token){
                    $data['remember_token'] = hash('sha256', Str::random(80));
                }
                users::create($data);
                return redirect()->route('users.index');

            }
            else{
                $request->session()->put('message', 'Этот логин не подходит');
                return redirect()->route('regist.index'); 
            }
        }
    }
    public function test(Request $request){
        
        $value = $request->session()->get('_token');
        print_r($value . '<br>');        
        print_r('8eQjXjNuwYNQjYsDJlRkUD30k72oIcOuGszYL3vp');
    }
}