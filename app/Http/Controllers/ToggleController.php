<?php

namespace App\Http\Controllers;

use App\Models\Gpio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ToggleController extends Controller
{

    public function handle(Request $request){
        
        $pin = Gpio::where('gpio_number', $request['gpioNumber']);
        
        if ($pin->state == 0){
            $newState = 1;
            $pin->update('state', $newState);
        } else {
            $newState = 0;
            $pin->update('state', $newState);
        };

        Artisan::call('relay:toggle');
        return redirect()->route('home');
    }
}
