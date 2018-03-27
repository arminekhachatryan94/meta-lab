<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SettingsController extends Controller
{
    public function index(){
        $user = User::find(auth()->id());
        return view( 'settings.index', compact('user'));
    }

    public function username(){
    	$this->validate(request(), [
            'username' => 'required'
    	]);
        
        $user = User::find(auth()->user()->id);

        $user1 = User::where('username', request('username')) -> first();
        
        if( count($user) == 1 && $user->username == request('username') ){
            return back()->withErrors([
    			'error' => "You entered the same username."
    		]);
        } else if( count($user1) == 1 && $user1->username == request('username') ){
    		return back()->withErrors([
    			'error' => "Username is already taken."
    		]);
        }

    	$user->username = request('username');
    	$user->save();
    	session()->flash('message', 'Username successfully changed');
    	
    	return redirect('settings');
    }

    public function email(){

    	$this->validate(request(), [
            'email' => 'required|email'
        ]);
        
        $user = User::find(auth()->user()->id);

        $user1 = User::where('email', request('email')) -> first();
        
        if( count($user) == 1 && $user->email == request('email') ){
            return back()->withErrors([
    			'error' => "You entered the same email."
    		]);
        } else if( count($user1) == 1 && $user1->email == request('email') ){
    		return back()->withErrors([
    			'error' => "Email is already taken."
    		]);
        }
        
    	$user->email = request('email');
    	$user->save();
    	session()->flash('message', 'Email successfully changed');
    	
    	return redirect('settings');
    }

}
