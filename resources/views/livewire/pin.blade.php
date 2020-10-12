<div class="w-full border-2 rounded-md p-4 border-cool-gray-400 text-center relative
    @if ($state == 1)  
    bg-green-200
    @else
    bg-yellow-200
    @endif
    ">
    <h2 class="text-xl text-cool-gray-800">Pin number:<span>{{$gpioNumber}}</span></h2>
    <div class="text-xl text-cool-gray-800">
    @if ($state == 1)
        is ON
    @elseif ($state == 0)
        is OFF
    @else
        is UNDEFINED
    @endif
    </div>
    <form class="flex flex-col" wire:submit.prevent="toggle">
        <input type="hidden" wire:model="state">
        <div class="m-auto">
            <button class="border-2 border-cool-gray-400 rounded-md p-2 m-4 bg-cool-gray-300 text-xl" wire:click="$refresh" type="submit">Switch</button>
        </div>
    </form>
    {{-- Stop trying to control. --}}
    @if (session()->has('message'))
    <div class="bg-green-200 p-4 m-auto text-center absolute top-48 rounded-md">
        {{ session('message') }}
    </div>
@endif
    <div class="bg-orange-200 p-4 m-auto text-center absolute top-48 rounded-md" wire:loading>
        Processing your request
    </div>


</div>
