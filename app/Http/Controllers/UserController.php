<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
        return users::all();
    } 
    public function showMain(Request $request, $id)
    // print start page 
    {   
        return view('main', users::find($id));
    }

    public function showView($path){
        return view($path);
    }


    public function checkUser(Request $request){
        $data = request()->validate([
            'email' => 'string',
            'password' => 'string'
        ]);

        $request->session()->forget('message');

        foreach($this->getAllUsers() as $user){
            if($user->email == $data['email'] and $user->password === md5($data['password'])) {
                return redirect()->route('mainList.show', $user->id);
            }
            else{
                $request->session()->put('message', 'Неверный логин или пароль');
                return redirect()->route('users.index');
            }
        }
        
    }



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
                if($user->email === $data['email']){
                    $isExise = false;  
                    $request->session()->forget('message');
                }     
            }
            if($isExise){
                $user = users::create($data);
                return redirect()->route('users.index');
            }
            else{
                request()->session()->put('message', 'Этот логин не подходит');
                return redirect()->route('regist.index'); 
            }
        }
    }
    public function test(Request $request){
        // $request->session()->put('message', '');
        // $value = $request->session()->get('message');
        $value = session('message');
        print_r($value);
    }
}