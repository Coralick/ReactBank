<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Laravel</title>

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        {{-- Style --}}
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="block">

            <form action="{{ route('input.check')}}" method="post" class="formStyle">
                <h1>Вход</h1>
                @csrf
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="btn btn-outline-primary">Вход</button>
                <p>{{session('message')}}</p>
                <a href="/regist">Вы не зарегестрированны?</a>
            </form>
            
        </div>
    </body>
</html>
