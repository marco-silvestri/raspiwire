<form action="{{route('create')}}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$pin['id']}}">
    <input type="hidden" name="updateMode" id="updateMode" value="true">
    <button type="submit">Edit</button>
</form>