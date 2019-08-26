<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function reset(){
        $table = new Admin();
        $table->name = 'admin';
        $table->email = 'admin@gmail.com';
        $table->password = Hash::make('00000000');
        $table->save();
    }
    function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $admin_data = array(
            'email'  => $request->email,
            'password' => $request->password
        );
        if(!Auth::guard('admin')->attempt($admin_data)) {
            session()->flash('message.head', 'danger');
            session()->flash('message.body', 'Invalid login details!');
            return redirect(route('admin_login'));
        }

        session()->flash('message.head', 'success');
        session()->flash('message.body', 'You are login!');
        return redirect(route('admin_dashboard'));
    }
}
