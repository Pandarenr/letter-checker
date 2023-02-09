<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <div class="container-main">
            <div class="container-content">
                <div class="container-interact">
                    <div class="flex justify-end">
                        
                    </div>
                    <form method="POST" action="{{ route('string-send') }}">
                        @csrf
                        <div class="flex flex-col">
                            <textarea type="text" class="input-main" id="string" name="string" 
                            placeholder="Введите строку">@if($data){{ $data['string'] }}@endif</textarea>
                            <div class="flex justify-between">                                
                                <div class="flex ml-4 items-center">
                                    <label for="">Язык строки:</label>
                                    <span class="text-output m-0 ml-4" id="lang">
                                        @if($data)
                                            {{ $data['lang'] }}
                                        @endif
                                    </span>
                                    <p id="values"></p>
                                </div>
                                <a href="{{ route('mainpage') }}" class="btn btn-main mt-4c">
                                    Очистить
                                </a>
                                <button type="submit" class="btn btn-main">
                                    Проверить
                                </button>
                            </div>
                        </div>
                    </form>                    
                    <div class="text-output" id="output">
                        @if($data)
                            {!! $data['marked-string'] !!}
                        @endif
</div>
                </div>
                <div class="flex justify-center my-4">
                    <label for="">История проверок</label>
                </div>
                <table>
                    <thead>
                        <th>
                            Строка
                        </th>
                        <th>
                            Язык
                        </th>
                        <th>
                            Дата
                        </th>
                    </thead>
                    <tbody>
                        @foreach($history as $item)
                            <tr>
                                <td class="td-string">
                                    {{ $item->string }}
                                </td>
                                <td>
                                    {{ $item->lang }}
                                </td>
                                <td>
                                    {{ $item->updated_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="/js/app.js" async></script>
    </body>
</html>
