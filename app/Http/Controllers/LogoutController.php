<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;


class LogoutController extends Controller
{
    public function index(Request $request) {
        Auth::logout();
        
        return Redirect::route('found');
    }
}
