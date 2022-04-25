<?php

namespace App\Http\Livewire;

use App\Models\Gpio;
use Livewire\Component;
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

    public function switchOn()
    {
        $totalMounted = Gpio::where('state', 1)
            ->get()
            ->count();

        $this->deviceSuffix = $totalMounted == 0 ? '/dev/sda2' : '/dev/sdb2';

        $response = Http::withHeaders([
            'MOUNT-POINT' => $this->deviceSuffix,
            'MOUNT-DESTINATION' => $this->pin->mount_destination,
            'PIN-OUT' => $this->gpioNumber,
        ])->get('127.0.0.1:3000/switchOn');

        abort_unless($response->ok(), 500, "Could not fetch data");
        Gpio::where('id', $this->pin->id)
            ->update([
                'mount_source' => $this->deviceSuffix,
                'state' => 1,
            ]);

        $this->pin = $this->pin->fresh();
        $this->isMounted = 0;
    }

    public function switchOff()
    {
        $response = Http::withHeaders([
            'MOUNT-POINT' => $this->deviceSuffix ?? 'not-available',
            'MOUNT-DESTINATION' => $this->pin->mount_destination,
            'PIN-OUT' => $this->gpioNumber,
        ])->get('127.0.0.1:3000/switchOff');

        abort_unless($response->ok(), 500, "Could not fetch data");

        Gpio::where('id', $this->pin->id)
            ->update([
                'mount_source' => null,
                'state' => 0,
            ]);
    }

    protected function stateChanger($state)
    {
        $this->state = $state;
        $this->pin->update(['state' => $this->state]);
    }

    public function render()
    {
        if (isset($this->isMounted)) {
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
