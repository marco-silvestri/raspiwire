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
    protected $isMounted;

    public function mount(){
        $this->pin = Gpio::where('gpio_number', $this->gpioNumber)->first();
    }

    public function toggle(){
        if ($this->state == 0){
            $state = 1;
            exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $state, $out, $toggleExit);
            $this->stateChanger($state);
            } else {
                $this->stateChanger(0);
                exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
            }
    }

    protected function stateChanger($state){
        $this->state = $state;
        $this->pin->update(['state' => $this->state]);
    }

    public function render(){
        if (isset($this->state)){
            switch ($this->state) {
                case 0:
                    $message = "Pin is now ON";
                    break;
                case 1:
                    $message = "Pin is now OFF";
                case !0 || !1:
                    $message = "Error! Resetting pin to OFF";
                    $this->stateChanger(0);
                default:
                    $message = "42.";
                    break;
            }
            session()->flash('message', $message);
            return view('livewire.pin', $this->pin);
        } else {
            return view('livewire.pin', $this->pin);
        }
    }
}
