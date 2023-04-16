<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
        return users::all();
    } 
    public function index(){
        // print start page
        foreach($this->getAllUsers() as $user){
            dump($user->name);
        }
    }
}
