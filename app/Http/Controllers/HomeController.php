<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpio;

class HomeController extends Controller
{
    function index(){
        $gpio = Gpio::get();
        return view('welcome', compact('gpio'));
    }
}
