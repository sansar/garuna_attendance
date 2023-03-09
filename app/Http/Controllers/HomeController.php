<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $lists = Attendance::all();
        return view('home.index', compact('lists'));
    }
}
