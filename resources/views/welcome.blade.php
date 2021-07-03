<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <title>LiveWire</title>
        @livewireStyles
    </head>

    <body>
        <!-- @livewire('comments') -->
        <livewire:comments />
        @livewireScripts
    </body>
</html>
