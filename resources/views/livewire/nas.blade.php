<tr @if ($state == 1)
    class="bg-green-100">
    @else
    class="bg-cool-gray-200">
    @endif   

    <td>
        {{$gpioNumber}}
    </td>

    <td>
        {{$category}}
    </td>

    <td>
        {{$name}}
    </td>

    <td>
        <span wire:loading>Processing</span> 
        <span wire:loading.remove>{{$state}}</span>
    </td>
    
    <td>
        <form class="flex flex-col" wire:submit.prevent="toggle">
            <input type="hidden" wire:model="state">
            <div class="m-auto">
                <button wire:click="$refresh" type="submit">Switch</button>
            </div>
        </form>
    </td>
    <td>
        @include('livewire.shared.editform')
    </td>
</tr>
