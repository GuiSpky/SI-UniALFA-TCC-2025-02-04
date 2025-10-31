<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('/', ['user' => $user]);
    }

}
