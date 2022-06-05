<?php

namespace App\Http\Livewire;

use App\Models\Gpio;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
        do {
            exec("sudo -S mount UUID='{$this->pin->hd_uuid} {$this->pin->mount_destination}", $out, $exitCode);
            sleep(10);
        } while ($exitCode != 0);
        if ($exitCode == 0) {
            $this->pin->update(['state' => 1]);
        }
    }

    public function switchOff()
    {
        exec("sudo -S umount -f -l {$this->pin->mount_destination}", $out, $exitCode);
        if ($exitCode != 0) {
            Log::error($out);
        } else {
            $this->pin->update(['state' => 0]);
            exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$this->gpioNumber} 0", $out, $err);
            Log::info($out);
        }
    }

    public function forceReset()
    {
        $this->pin->update([
                'state' => 0,
            ]);
    }

    public function render()
    {
        return view('livewire.nas', $this->pin);
    }
}
