<div>
    <form class="flex flex-col" wire:submit.prevent="createLinks">
        <input type="text" wire:model="videoUrl">
        <div class="m-auto">
            <button class="border-2 border-cool-gray-400 rounded-md p-2 m-4 bg-cool-gray-300 text-xl" wire:click="$refresh" type="submit">Download</button>
        </div>
    </form>
    @if ($step == 'ready')
    <ul>
    @foreach ($results as $link)
    <li>
        <a href="{{$link['url']}}">{{$link['format']}}</a>
    </li>
    @endforeach
    </ul>
    @endif
</div>
