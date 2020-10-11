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
        $this->pin = Gpio::where('gpio_number', $this->gpioNumber)->first();
    }

    public function toggle(){
        if ($this->state == 0){
            $this->state = 1;
            $this->pin->update(['state' => $this->state]);
            exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
            sleep(30);
            exec("sudo mount ".config('app.mount_source')." ".config('app.mount_destination'));
        } else {
            $this->state = 0;
            $this->pin->update(['state' => $this->state]);
            exec("sudo umount ".config('app.mount_destination'));
            sleep(30);
            exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
        }
    }

    public function render(){

        return view('livewire.pin', $this->pin);
    }
}
