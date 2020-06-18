<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Found;

class AdminDuePostsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $currentPage = 'duePosts';
        $auction = Found::where('created_at', '<', date("Y-m-d", strtotime("-6 months")))
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('admin.duePosts', compact('auction'))
            ->with('currentPage', $currentPage);
    }
}
