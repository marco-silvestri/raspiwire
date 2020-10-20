<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Automation</title>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
    @livewireStyles
</head>
<body>
    <h1 class="text-4xl leading-4 m-4 text-center">
        Raspiwire
    </h1>
    <aside>
        <form action="{{route('create')}}" method="POST">
            @csrf
            <button type="submit">Add a device</button>
        </form>
        @livewire('downloader')
    </aside>
    <main class="m-8 flex sm:grid sm:grid-cols-4 sm:gap-4">
        @foreach ($gpio as $pin)
        @livewire($pin->category, ['gpioNumber' => $pin->gpio_number, 'state' => $pin->state])
        @endforeach
    </main>
    @livewireScripts
</body>
</html>
