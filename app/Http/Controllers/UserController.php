<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function  loginForm(){
        return view('login');
    }
    function signup(Request $request){
        $this->validate($request,[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'mobile_number' => ['required'],
            'postal_code' => ['required']
        ]);

        $table = new User();
        $table->email = $request->email;
        $table->mobile_number = $request->mobile_number;
        $table->password = Hash::make($request->password);
        $table->postal_code = $request->postal_code;
        $table->save();
    }
    function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if(Hash::check($request->password,$user['password'])){
            if($user['validate']){
                $user_data = array(
                    'email'  => $request->email,
                    'password' => $request->password
                );
                if(Auth::attempt($user_data)){
                    if($user['admin']) {
                        session(['admin' => 1]);
                    }
                   return redirect(route('home'));
                }
            }else{
                session()->flash('message.head', 'danger');
                session()->flash('message.body','Check your email for Verification link!');
                return back();
            }
        }
        session()->flash('message.head', 'danger');
        session()->flash('message.body','Invalid login details!');
        return back();

    }
    function logout(){
        Auth::logout();
        return redirect('login');
    }

    function update(Request $request){
        if($request->email){
            $this->validate($request, [
                'email' => 'required',
                'confirm_email' => 'required',
            ]);
            if($request->email!=$request->confirm_email){
                session()->flash('message.head', 'danger');
                session()->flash('message.body','Email must be confirm!');
                return back();
            }
            User::where('id',Auth::user()->id)->update(['email'=>$request->email]);
            session()->flash('message.head', 'success');
            session()->flash('message.body','My details updated!');
            return back();
        }
        if($request->password){
            $this->validate($request, [
                'password' => 'required',
                'confirm_password' => 'required',
            ]);
            if($request->password!=$request->confirm_password){
                session()->flash('message.head', 'danger');
                session()->flash('message.body','Password must be confirm!');
                return back();
            }
            User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->password)]);
            session()->flash('message.head', 'success');
            session()->flash('message.body','My details updated!');
            return back();
        }
        if($request->mobile_number){
            $this->validate($request, [
                'mobile_number' => 'required',
                'confirm_mobile_number' => 'required',
            ]);
            if($request->mobile_number!=$request->confirm_mobile_number){
                session()->flash('message.head', 'danger');
                session()->flash('message.body','Mobile number must be confirm!');
                return back();
            }
            User::where('id',Auth::user()->id)->update(['mobile_number'=>$request->mobile_number]);
            session()->flash('message.head', 'success');
            session()->flash('message.body','My details updated!');
            return back();
        }
        if($request->postal_code){
            $this->validate($request, [
                'postal_code' => 'required',
                'confirm_postal_code' => 'required',
            ]);
            if($request->postal_code!=$request->confirm_postal_code){
                session()->flash('message.head', 'danger');
                session()->flash('message.body','Postal code must be confirm!');
                return back();
            }
            User::where('id',Auth::user()->id)->update(['postal_code'=>$request->postal_code]);
            session()->flash('message.head', 'success');
            session()->flash('message.body','My details updated!');
            return back();
        }
    }
}
