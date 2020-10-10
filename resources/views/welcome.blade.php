
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @livewireStyles
</head>
<body>
    <h1>
        Home automation
    </h1>
    <main>
        @foreach ($gpio as $pin)
        @livewire('pin', ['gpioNumber' => $pin->gpio_number, 'state' => $pin->state])    

        @endforeach
    </main>
    @livewireScripts
</body>
</html>
