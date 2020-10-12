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
            $this->stateChanger(1);
            exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $toggleExit);
            do {
                exec("sudo mount ".config('app.mount_source')." ".config('app.mount_destination'),$out, $exitCode);
            } while ($exitCode != 0);
            
        } else {
            exec("sudo umount -f -l ".config('app.mount_destination'), $out, $exitCode);
            if($exitCode != 0){
                $this->isMounted = $out;
            } else {
                $this->stateChanger(0);
                exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
            }
        }
    }

    protected function stateChanger($state){
        $this->state = $state;
        $this->pin->update(['state' => $this->state]);
    }

    public function render(){
        return view('livewire.pin', $this->pin);
    }
}
