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
                <a href="/create">Новый сотрудник</a>
            </div>
            <div class="row my-4">
                <div class="col mx-auto">
                    @if (session()->has('success'))
                    <div class="alert alert-success rounded">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if (session()->has('failure'))
                    <div class="alert alert-warning rounded">
                        {{ session()->get('failure') }}
                    </div>
                    @endif

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
                                <th scope="col">Действия</th>
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
                                <td>
                                    <form action="{{ route('destroy', $tag->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                    </form>
                                </td>
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

