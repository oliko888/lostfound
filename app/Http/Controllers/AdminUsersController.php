<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    private $currentPage;
    private $currentUser;
    private $users;

    public function __construct() {
        $this->middleware('auth');
        $this->currentPage = 'users';
        $this->users = User::all();
    }

    public function index() {
        $currentUser = Auth::user();

        return view('admin.users')
            ->with('users', $this->users)
            ->with('currentUser', $currentUser)
            ->with('currentPage', $this->currentPage);
    }

    public function update($id, Request $request) {
        $currentUser = Auth::user();

        if($request->pw1 == $request->pw2) {
            $pw = Hash::make($request->pw1);
            $user = User::find($id);
            $user->password = $pw;
            $user->save();
            
            return view('admin.users')
                ->with('users', $this->users)
                ->with('currentUser', $currentUser)
                ->with('currentPage', $this->currentPage)
                ->with('success', 'Salasõna on muudetud!');
        } else {
            return view('admin.users')
                ->with('users', $this->users)
                ->with('currentUser', $currentUser)
                ->with('currentPage', $this->currentPage)
                ->with('error', 'Salasõna lahtrid ei ühti!');
        }
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

}
