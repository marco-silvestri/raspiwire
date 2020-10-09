<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpio;

class ToggleNas extends Controller
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

        return redirect()->route('home');
    }
}
