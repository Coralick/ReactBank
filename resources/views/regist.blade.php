<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        <!-- Styles -->
        <style>

            .block{
                width: 100vw;

            }
            .formStyle{
                
                text-align: center;
                margin: 15% auto;
                width: 500px;
                display: flex;
                justify-content: center;
                flex-direction: column;
            }
            .formStyle>input{
                border: 1px solid grey;
                border-radius: 6px;
                height: 40px;
                margin: 5px 0;
            }
        </style>
        
    </head>
    <body>
        <div class="block">
            <form action="{{ route('regist.check')}}" method="post" class="formStyle">
                <h1>Регистрация</h1>
                @csrf
                <input type="text" placeholder="name" name="name">
                <input type="text" placeholder="lastname" name="lastname">
                <input type="text" placeholder="Phone number" name="phoneNumber">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Password repeat" name="passwordRepeat">
                <button type="submit" class="btn btn-outline-primary">Зарегестрировать</button>
                <p>{{session('message')}}</p>
                <a href="/">У вас уже есть аккаунт? </a>
            </form>
            
        </div>
    </body>
</html>
