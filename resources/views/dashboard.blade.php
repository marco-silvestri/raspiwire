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
    <main class="m-8 flex flex-col">
        <h2>Devices</h2>
        <form action="{{route('create')}}" method="POST">
            @csrf
            <button type="submit">Add a device</button>
        </form>
        <table>
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
                    <th colspan="2">
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
    </main>
    @livewireScripts
</body>
</html>
