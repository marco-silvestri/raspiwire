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
            <button onclick="toggleGpioState()" type="submit">Switch</button>
        </form>
        {{-- Stop trying to control. --}}
</div>

<script type="module">

</script>
