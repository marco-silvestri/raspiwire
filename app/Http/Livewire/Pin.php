<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gpio;
use PDO;

class Pin extends Component
{
    public $gpioNumber;
    public $state;
    public $pin;

    public function mount(){
        //dd($this->gpioNumber);
        $this->pin = Gpio::where('gpio_number', $this->gpioNumber)->first();
    }

    public function toggle(){
        if ($this->state == 0){
            $this->state = 1;
            $this->pin->update(['state' => $this->state]);
        } else {
            $this->state = 0;
            $this->pin->update(['state' => $this->state]);
        }
        exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
    }

    public function render(){

        return view('livewire.pin', $this->pin);
    }
}
