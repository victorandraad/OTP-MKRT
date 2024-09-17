<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentPosts = Post::with('user')->latest()->take(6)->get();
        return view('dashboard', compact('recentPosts'));
    }
}
