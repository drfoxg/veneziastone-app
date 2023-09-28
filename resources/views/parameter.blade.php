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
                <a href="/">На главную</a>
            </div>
            <div class="row my-4">
                <div class="col mx-auto">
                    @isset($parameters)
                        @if ($parameters->isEmpty())
                        <div>
                            Извините, нет параметров.
                        </div>
                        @else
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">НДФЛ</th>
                                <th scope="col">Надбавка за возраст (от {{$parameters->first()->age_line}})</th>
                                <th scope="col">Льгота за детей (от {{$parameters->first()->children_line}})</th>
                                <th scope="col">Служебная машина</th>
                              </tr>
                            </thead>
                            <tbody>
                        @foreach ($parameters as $tag)
                              <tr>
                                <th scope="row">{{$tag->id}}</th>
                                <td>{{$tag->personal_income_tax}}%</td>
                                <td>{{$tag->age_tax}}%</td>
                                <td>{{$tag->children_tax}}%</td>
                                <td>{{$tag->car_rent}} {{$tag->currency_name}}</td>
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

