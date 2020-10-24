<?php

namespace App\Http\Controllers;

use App\Models\Gpio;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function handle(){
        $count = User::count();

        return view('welcome', compact('count'));
    }
}
