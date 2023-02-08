<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <div class="h-screen flex justify-center items-center">
            <div class="flex flex-col">
                <form method="POST" action="{{ route('string-send') }}">
                    @csrf
                    <div class="">
                        <input type="text" id="string" name="string" value="@if($data) {{ $data['string'] }} @endif" class=>
                        <button class="btn btn-primary">
                            Проверить
                        </button>
                    </div>
                </form>
                <div>
                    @if($data)
                        {!! $data['marked-string'] !!}
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
