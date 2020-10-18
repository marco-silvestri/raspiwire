
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
        Dashboard automation
    </h1>
    <main class="m-8 flex sm:grid sm:grid-cols-4 sm:gap-4">
        <div>
        <a href="{{route('register')}}">Register</a>
        </div>

        <div>
            <a href="{{route('login')}}">Login</a>
        </div>
    </main>
    @livewireScripts
</body>
</html>
