<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Metrics extends Component
{
    public $metrics = [
        'cpuTemp' => '',
        'uptime' => '',
    ];

    public function metrics(){
        exec('sudo vcgencmd measure_temp', $outVcGend, $retVcGend);
        exec('uptime', $outUptime, $retUptime);

        $this->metrics['cpuTemp'] = $outVcGend;
        $this->metrics['uptime'] = $outUptime;
    }

    public function render()
    {
        $this->metrics();
        return view('livewire.metrics', $this->metrics);
    }
}
