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
                    <h2>Добавить сотрудника</h2>
                    @isset($employer)
                    <p>Сотрудник: {{$employer}}</p>
                    @endisset

                    <form action="{{route($routeName)}}" method="POST" enctype="multipart/form-data" class="p-1">
                        @csrf
                        <div class="d-flex flex-column col-md-4">

                            <div class="form-group">
                                <label for="name" class="mr-2">Имя:&nbsp;</label>
                                <input type="text" class="form-control" autocomplete="off" name="name" id="name" placeholder="Имя" required="" pattern="^.+$" value="">
                            </div>
                            <div class="form-group">
                                <label for="age" class="mr-2">Возраст (целое число):&nbsp;</label>
                                <input type="text" class="form-control" autocomplete="off" name="age" id="age" placeholder="Возраста" required="" pattern="[1-9][0-9]*" value="">
                            </div>

                            <div class="form-group">
                                <label for="is_car" class="mr-2">Есть машина (Да/Нет):&nbsp;</label>
                                <input type="text" class="form-control" autocomplete="off" name="is_car" id="is_car" placeholder="" required="" pattern="^(?:Да|Нет|да|нет)$" value="">
                            </div>

                            <div class="form-group">
                                <label for="children" class="mr-2">Дети (число от 0):&nbsp;</label>
                                <input type="text" class="form-control" autocomplete="off" name="children" id="children" placeholder="" required="" pattern="[0]|[1-9][0-9]*" value="">
                            </div>

                            <div class="form-group">
                                <label for="salary" class="mr-2">Оклад:&nbsp;</label>
                                <input type="number" class="form-control" autocomplete="off" name="salary" id="salary" placeholder="" required="" pattern="[1-9][0-9]*" value="">
                            </div>
                            <br />
                            <div class="d-flex flex-row justify-content-end">
                                <a href="{{route($routeBack)}}" class="btn btn-primary m-1" name="cancel">Отмена</a>
                                <button type="submit" class="btn btn-primary m-1" value="Добавить" name="store">Добавить</button>
                            </div>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row my-4">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>

        </.div>
        @vite(['resources/js/app.js'])
    </body>
</html>

