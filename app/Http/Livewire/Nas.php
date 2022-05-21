<?php

namespace App\Http\Livewire;

use App\Models\Gpio;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Nas extends Component
{
    public $gpioNumber;
    public $state;
    public $pin;
    public $category;
    public $name;
    public $deviceSuffix;
    protected $isMounted;

    public function mount(){
        $this->pin = Gpio::where('gpio_number', $this->gpioNumber)
            ->where('category', 'nas')
            ->first();
    }

    public function toggle(){
        if ($this->state == 0){

            $totalMounted = Gpio::where('state', 1)
            ->get()
            ->count();
        
        $this->deviceSuffix = $totalMounted == 0 ? '/dev/sda2' : '/dev/sdb2';

        Gpio::where('id', $this->pin->id)
            ->update([
                'mount_source' => $this->deviceSuffix,
            ]);

            $this->pin = $this->pin->fresh();

            $state = 1;
            exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js ".$this->gpioNumber . " " . $state, $out, $toggleExit);
            do {
                exec("sudo -S mount ".$this->pin->mount_source." ".$this->pin->mount_destination, $out, $exitCode);
                sleep(10);
            } while ($exitCode != 0);

            if ($exitCode == 0){
                $this->stateChanger($state);
            }
            $this->isMounted = 0;
        } else {
            exec("sudo -S umount -f -l ".$this->pin->mount_destination, $out, $exitCode);
            if($exitCode != 0){
                $this->isMounted = $exitCode;
            } else {
                $this->stateChanger(0);
                Gpio::where('id',$this->pin->id)
                    ->update([
                        'mount_source' => null,
                    ]);
                exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js ".$this->gpioNumber . " " . 0, $out, $err);
                $this->isMounted = $err;
            }
        }
    }

    public function forceReset()
    {
        Gpio::where('id', $this->pin->id)
        ->update([
            'state' => 0,
        ]);
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
            return view('livewire.nas', $this->pin);
        } else {
            return view('livewire.nas', $this->pin);
        }
    }
}
