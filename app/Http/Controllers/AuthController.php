<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function reset(){
        $table = new User();
        $table->name = 'admin';
        $table->email = 'user@gmail.com';
        $table->password = Hash::make('00000000');
        $table->save();
    }

    function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user_data = array(
            'email'  => $request->email,
            'password' => $request->password
        );
        if(!Auth::attempt($user_data)) {
            session()->flash('message.head', 'danger');
            session()->flash('message.body', 'Invalid login details!');
            return redirect(route('login'));
        }

        session()->flash('message.head', 'success');
        session()->flash('message.body', 'You are login!');
        return redirect(route('home'));
    }
}
