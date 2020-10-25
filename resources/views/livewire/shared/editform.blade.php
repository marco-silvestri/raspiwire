<form action="{{route('create')}}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$pin['id']}}">
    <input type="hidden" name="updateMode" id="updateMode" value="true">
    <button class="w-8 h-8 align-middle" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
    </button>
</form>