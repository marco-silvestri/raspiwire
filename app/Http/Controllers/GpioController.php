<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Gpio;

class GpioController extends Controller
{
    public function index()
    {
        if (!Auth::user()){
            return view('welcome');
        }else {
            $gpio = Gpio::get();
            return view('dashboard', compact('gpio'));
        }
    }

    public function create(Request $request)
    {
        if (isset($request['updateMode'])){
            $gpio = Gpio::findOrFail($request['id']);
            $updateMode = true;
            return view('livewire.gpio-crud', compact('gpio', 'updateMode'));
        } else {
            $updateMode = false;
            return view('livewire.gpio-crud', compact('updateMode'));
        }        
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['updateMode'] == "true"){
            $gpio = Gpio::findOrFail($data['id']);
            $gpio->update([
                'gpio_number' => $data['gpioNumber'],
                'category' => $data['category'],
            ]);
            //$message = 'Gpio device ' . $data['gpioNumber'] . ' created succesfully';
        } else {
            $gpio = Gpio::create([
                'gpio_number' => $data['gpioNumber'],
                'category' => $data['category'],
                'state' => 0,
            ]);
            //$message = 'Whoooops, there was an error. Please try again';
        }

        return redirect(route('dashboard'));
    }

    public function destroy(Request $request)
    {
        $gpio = Gpio::findOrFail($request['id']);
        $isDeleted = $gpio->delete();

        if ($isDeleted){
            return redirect(route('dashboard'));
        }
    }
}
