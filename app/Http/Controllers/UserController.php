<?php

namespace App\Http\Controllers;
use App\Models\account;
// use App\Models\loan;
use App\Models\users;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getAllUsers(){
        return users::all();
    }



    public function getUser($request){
        return users::where('remember_token', $request->session()->token())->first();
    }



    // Show main list and get data for it
    public function showUserInfo(Request $request)
    { 
        $user = $this->getUser($request);
        
        if(isset($user)){
            $data = ['user' => ['name' => $user->name, 'lastname' => $user->lastname]];
            // get Account
            $account = $user->account;            
            if($account){      
                $data['cash'] =  $account->cash;
            }
            else{
                $account = null;
            }
            
            // get Loans 
            $loans = $user->loans; 

            
            if($loans ){
                $data['loans'] = $loans;
            } 
            
            else{
                $data['loans'] = null;
            }
            return response()->json($data);
            }
        else {
            return response()->json(['error' => "User id not defind", 'code' => 500]);
        }
    }

    

    









    // Entrance user 
    public function checkUser(Request $request){
        $data = request()->validate([
            'email' => 'string',
            'password' => 'string',
        ]);


        // check for enter in system
        foreach($this->getAllUsers() as $user){
            if($user->email == $data['email'] and $user->password === md5($data['password'])){
                $request->session()->put('_token', $user->remember_token);
                return response()->json(); 
            }   

        }
        return response()->json(['message' => 'Не правильный логин или пароль']);
        
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
        ]);


        // check right data
        
            foreach($this->getAllUsers() as $user){
                // check repeated data
                if($user->email === $data['email'] || $user->phoneNumber === $data['phoneNumber'] ){
                    $isExise = false;
                }     
            }

            
            // register users
            if($isExise){
                // create user
                $data['password'] = md5($data['password']);
                $data['remember_token'] = hash('sha256', Str::random(80));
                users::create($data);

                // creaete users account
                foreach(users::where('remember_token', '=',  $data['remember_token'])->get() as $user){
                    $id = $user->id;
                }
                $dataAccount = [
                    'cash' => 0,
                    'users_id' => $id,
                ];

                account::create($dataAccount);

                return response()->json();
            }
            else{
                return response()->json(['message' => 'Этот пользователь уже зарегестрирован']); 
            }
        
    }


    // test function 
    public function test(Request $request){
        // $value = $request->session()->get('_token');
        // print_r($value . '<br>');        
        // print_r($request->session());
        // print_r(csrf_token());
        $data = ['token' => csrf_token()];
        // dd($data);
        return response()->json($data);
        // return view('enter');
    }

}