<div>
    <h2>Pin number:<span>{{$gpioNumber}}</span></h2>
       @if ($state == 1)
        <div style="background-color: #00FF00;">
            is ON
        </div>
        @elseif ($state == 0)
        <div style="background-color: #FF0000;">
            is OFF
        </div>
        @else
        <div style="background-color: #0000FF;">
            is UNDEFINED
        </div>
        @endif
        {{$state}}
        <form wire:submit.prevent="toggle">
            <input type="hidden" wire:model="state">
            <button onclick="toggleGpioState(pinOut{{$gpioNumber}})" type="submit">Switch</button>
        </form>
        {{-- Stop trying to control. --}}
</div>

<script>
//var Gpio = require('onoff').Gpio; //include onoff to interact with the GPIO
var pinOut{{$gpioNumber}} = new Gpio({{$gpioNumber}}, 'out'); //use GPIO pin passed by blade, and specify that it is output
var state{{$gpioNumber}} = {{$state}};

function toggleGpioState(pinOut){
    if (pinOut.readSync() === 0){ //check the pin state, if the state is 0 (or off)
        let state = 1;
    } else {
        let state = 0;
    }
    pinOut.writeSync(state); //set pin state
}
</script>
