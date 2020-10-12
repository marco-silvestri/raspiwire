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
            do {
                exec("sudo mount ".config('app.mount_source')." ".config('app.mount_destination'),$out, $exitCode);
                sleep(15);
            } while ($exitCode != 0);

            if ($exitCode == 0){
                $this->stateChanger($state);
            }
            $this->isMounted = 0;
        } else {
            exec("sudo umount -f -l ".config('app.mount_destination'), $out, $exitCode);
            if($exitCode != 0){
                $this->isMounted = $exitCode;
            } else {
                $this->stateChanger(0);
                exec("node ". base_path() ."/toggle.js ".$this->gpioNumber . " " . $this->state, $out, $err);
                $this->isMounted = $err;
            }
        }
    }

    protected function stateChanger($state){
        $this->state = $state;
        $this->pin->update(['state' => $this->state]);
    }

    public function render(){
        if (isset($this->isMounted)){
            switch ($this->isMounted) {
                case 0:
                    $message = "Unit successfully mounted!";
                    break;
                case !0:
                    $message = "Error! Device might be busy.";
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
