<div>
    @if ($updateMode)
    <form action="{{route('store')}}" method="POST" name="update">
        @csrf
        <input type="hidden" id="updateMode" name="updateMode" value="true">
        <input type="hidden" id="id" name="id" value="{{$gpio['id']}}">
        <input type="number" id="gpioNumber" name="gpioNumber" value="{{$gpio['gpio_number']}}" placeholder="{{$gpio['gpio_number']}}">
        <input type="text" id="category" name="category" value="{{$gpio['category']}}" placeholder="{{$gpio['category']}}">
        <input type="text" id="name" name="name" value="{{$gpio['name']}}" placeholder="{{$gpio['name']}}">
        <button type="submit">Update</button>
    </form>
    <form action="{{route('delete')}}" method="POST" name="update">
        @method('DELETE')
        @csrf
        <input type="hidden" id="id" name="id" value="{{$gpio->id}}">
        <button type="submit">Remove</button>
    </form>
    @else
    <form action="{{route('store')}}" method="POST" name="create">
        @csrf
        <input type="hidden" id="updateMode" name="updateMode" value="false">
        <input type="number" id="gpioNumber" name="gpioNumber" value="" placeholder="Gpio Number">
        <input type="text" id="category" name="category" value="" placeholder="Device category">
        <input type="text" id="name" name="name" value="" placeholder="Device neme">
        <button type="submit">Create</button>
    </form>
    @endif
    {{-- Stop trying to control. --}}
</div>
