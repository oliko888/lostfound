<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Found;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function duePosts() {
        $currentPage = 'duePosts';
        $auction = Found::where('created_at', '<', date("Y-m-d", strtotime("-6 months")))
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('admin.duePosts', compact('auction'))
            ->with('currentPage', $currentPage);
    }

    public function categories() {
        $currentPage = 'categories';
        $categories = DB::table('categories')->get();

        return view('admin.categories', compact('categories'))
            ->with('currentPage', $currentPage);
    }

    public function locations() {
        $currentPage = 'locations';
        $locations = DB::table('locations')->get();

        return view('admin.locations', compact('locations'))
            ->with('currentPage', $currentPage);
    }

    public function users() {
        $currentPage = 'users';
        $currentUser = auth()->user();   
        $users = User::all();

        return view('admin.users', compact('users'))->with('currentUser', $currentUser)
            ->with('currentPage', $currentPage);
    }

}
