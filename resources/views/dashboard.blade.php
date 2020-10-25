<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspiwire</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @livewireStyles
</head>
<body>
    <h1 class="text-4xl leading-4 m-4 text-center">
        Raspiwire
    </h1>
    <main class="m-8 flex flex-col justify-evenly">
        <div class="flex items-center">
            <h2>Devices</h2>
            <form action="{{route('create')}}" method="POST">
                @csrf
                <button class="m-2 bg-purple-400 text-xs p-1 font-thin rounded-md" type="submit">Add a device</button>
            </form>
        </div>
        <table class="font-thin border border-gray-400 text-left">
            <thead>
                <tr>
                    <th>
                        Pin:
                    </th>
                    <th>
                        Device:
                    </th>
                    <th>
                        Name:
                    </th>
                    <th>
                        State:
                    </th>
                    <th colspan="2" class="text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($gpio as $pin)
                @livewire($pin->category, ['gpioNumber' => $pin->gpio_number, 'state' => $pin->state])
            @endforeach
            </tbody>
        </table>
        @livewire('metrics')
    </main>
    @livewireScripts
</body>
</html>
