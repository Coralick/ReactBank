<?php

namespace App\Http\Controllers;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function logOut(Request $request){
        $request->session()->put('_token', ' ');
        return response()->json();
    }
    public function showPage(Request $request){
        return view('main-page');
    }


}

