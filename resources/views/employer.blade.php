<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Laravel</title>
    </head>
    <body>
        <div class="container">
            <div class="row my-4">
                <h1 class="">Венеция стоун - Начисление зарплаты</h1>
                <a href="/parameters">Параметры</a>
            </div>
            <div class="row my-4">
                <div class="col mx-auto">
                    @isset($employers)
                        @if ($employers->isEmpty())
                        <div>
                            Извините, нет сотрудников.
                        </div>
                        @else
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Имя</th>
                                <th scope="col">Возраст</th>
                                <th scope="col">Машина</th>
                                <th scope="col">Дети</th>
                                <th scope="col">Оклад</th>
                                <th scope="col">Зарплата</th>
                              </tr>
                            </thead>
                            <tbody>
                        @foreach ($employers as $tag)
                              <tr>
                                <th scope="row">{{$tag->id}}</th>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->age}}</td>
                                <td>{{$tag->is_car}}</td>
                                <td>{{$tag->children}}</td>
                                <td>{{$tag->salary}} {{$tag->currency_name}}</td>
                                <td>{{$tag->paycheck}} {{$tag->currency_name}}</td>
                              </tr>
                            </tbody>
                        @endforeach
                        </table>
                        @endif
                    @endisset
                </div>
            </div>
            <div class="row my-4">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>

        </.div>
        @vite(['resources/js/app.js'])
    </body>
</html>

