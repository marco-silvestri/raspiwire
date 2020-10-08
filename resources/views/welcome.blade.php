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
        <div>
            <form action="{{ url('/switch') }}" method="GET">
                <input type="hidden" name="switch" value="toggle"> 
                <button type="submit">Switch</button>
            </form>
        </div>
    </main>
</body>
</html>
