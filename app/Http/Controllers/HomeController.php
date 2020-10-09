<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpio;
class HomeController extends Controller
{
    public function index(){
        $pin = GPIO::get();
        return view('welcome', compact('pin'));
    }
}
