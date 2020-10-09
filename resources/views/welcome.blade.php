<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Home automation
    </h1>
    <main>
        @foreach ($gpio as $pin)
        <div>
            <form method="GET" action="{{ route('switch') }}">
                @csrf
            <input type="hidden" value="{{$pin->gpio_number}}" id="gpioNumber" name="gpioNumber">
            <input type="hidden" value="{{$pin->state}}" id="state" name="state">
                <button type="submit">Switch</button>
            </form>
        </div>
        @endforeach
    </main>
</body>
</html>
