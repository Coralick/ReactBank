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
    public function getCSRF(Request $request){
        // $data = ['token' => csrf_token()];
        // return response()->json($data);
        $value = $request->session()->get('_token');
        print_r($value . '<br>');        
        print_r($request->session());
        print_r(csrf_token());
    }
    public function showPage(Request $request){
        
            return view('main-page');

    }
}

