<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <div class="container-main">
            <div class="container-content">
                <div class="container-interact">
                    <form method="POST" action="{{ route('string-send') }}">
                        @csrf
                        <div class="flex flex-col">
                            <input type="text" class="input-main" id="string" name="string" 
                            placeholder="Введите строку" value="@if($data) {{ $data['string'] }} @endif" />
                            <div class="flex justify-between">                                
                                <div class="flex ml-4 items-center">
                                    <label for="">Язык строки:</label>
                                    <p class="text-output m-0 ml-4">
                                        @if($data)
                                            {{ $data['lang'] }}
                                        @endif
                                    </p>
                                </div>
                                <button class="btn btn-main">
                                    Проверить
                                </button>
                            </div>
                        </div>
                    </form>                    
                    <p class="text-output">
                        @if($data)
                            {!! $data['marked-string'] !!}
                        @endif
                    </p>
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
    </body>
</html>
