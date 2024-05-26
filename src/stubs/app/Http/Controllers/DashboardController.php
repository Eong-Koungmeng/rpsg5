<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the top 10 users with the highest scores
        $topUsers = User::orderByDesc('score')->take(10)->get();

        return view('dashboard', compact('topUsers'));
    }
}
