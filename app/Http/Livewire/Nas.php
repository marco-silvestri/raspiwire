<?php

namespace App\Http\Livewire;

use App\Models\Gpio;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Nas extends Component
{
    public $gpioNumber;
    public $state;
    public $pin;
    public $category;
    public $name;
    public $deviceSuffix;
    protected $isMounted;

    public function mount()
    {
        $this->pin = Gpio::where('gpio_number', $this->gpioNumber)
            ->where('category', 'nas')
            ->first();
    }

    public function toggle()
    {
        if ($this->state == 0) {
            $this->switchOn();
        } else {
            $this->switchOff();
        }
    }

    public function switchOn()
    {
        exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$this->gpioNumber} 1", $out, $toggleExit);
        sleep(10);
        do {
            exec("sudo -S mount UUID=\"{$this->pin->hd_uuid}\" {$this->pin->mount_destination}", $out, $exitCode);
            sleep(10);
        } while ($exitCode != 0);
        if ($exitCode == 0) {
            $this->pin->update(['state' => 1]);
            $this->state = 1;
        }
    }

    public function switchOff()
    {
        exec("sudo -S umount -f -l {$this->pin->mount_destination}", $out, $exitCode);
        sleep(10);
        if ($exitCode != 0) {
            //Log::error($out);
        } else {
            $this->pin->update(['state' => 0]);
            exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$this->gpioNumber} 0", $out, $err);
            $this->state = 0;
            //Log::info($out);
        }
    }

    public function forceReset()
    {
        exec("sudo -S umount -f -l {$this->pin->mount_destination}", $out, $exitCode);
        $this->pin->update(['state' => 0]);
        sleep(10);
        exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$this->gpioNumber} 0", $out, $err);
        $this->state = 0;
    }

    public function render()
    {
        return view('livewire.nas', $this->pin);
    }
}
