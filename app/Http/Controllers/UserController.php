<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
        return users::all();
    } 
    public function showMain($data)
   
    // print start page 
    {   
        return view('main', users::find($data));
    }


    public function checkUser(){
        $data = request()->validate([
            'email' => 'string',
            'password' => 'string'
        ]);

        foreach($this->getAllUsers() as $user){
            if($user->email == $data['email'] and $user->password === $data['password']) {
                return redirect()->route('mainList.show', $user->id);
            }
            else{
                echo 'Неправильный логин или пароль!!';
            }
        }
    }
}
