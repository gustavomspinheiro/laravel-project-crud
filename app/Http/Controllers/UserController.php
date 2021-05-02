<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserController extends Controller
{
    public function registerForm(){
        return view('register');
    }

    public function storeUser(Request $request){
        $inputs = $request->except(['_token']);
        $user = new User();

        //preparing and filtering inputs
        $name = filter_var($inputs['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($inputs['email'], FILTER_VALIDATE_EMAIL);
        $password = Hash::make(($inputs['password']));
        
        //validate if values were fullfilled
        if(empty($name) || empty($email) || empty($password)){
            return redirect()->route('home');
        }

        //storing in database
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();
        return redirect()->route('home');
    }
}
