<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserRolesController extends Controller
{
    public function index() {
        $users = User::all();
        return view('roles.index', compact('users'));
    }
    public function store( $id ) {
        $role = request('role');
        $user = User::find($id);
        if( !$user ){
            return back()->withErrors([
    			'error' => "Couldn't change user role."
    		]);
        } else{
            if( $user->role == $role ){
                return back()->withErrors([
                    'error' => "You chose the same role."
                ]);
            }
            else {
                $user->role = $role;
                $user->save();
                session()->flash('message', 'User role was successfully changed');
                return back();
            }
        }
    }
}
