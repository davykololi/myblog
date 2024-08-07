<?php

namespace App\Http\Controllers\Authorization;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    //
    public function __construct()
    {

    }
    
    public function authourize()
    {
        $check = Auth::check();
        $user = Auth::user();
        if($check && $user->hasRole('admin')){
            return redirect('/admin/dashboard');
        } elseif($check && $user->hasRole('author')){
            return redirect('/author/dashboard');
        } elseif($check && $user->hasRole('editor')){
            return redirect('/editor/dashboard');
        } elseif($check && $user->hasRole('visitor')){
            return redirect()->intended();
        } else {
            Auth::logout();
            return redirect('/login')->with('error', 'You do not have access to this resource.');
        }
    }
}
