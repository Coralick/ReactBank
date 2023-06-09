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
            <form action="{{ route('add-loan.check')}}" method="post" class="formStyle">
                    <h1>Взять займ</h1>
                @csrf

                {{-- main input --}}
                <input type="number" placeholder="сумма(от 1000 до 150 000)" name="sum">
                <select name="period" class="form-select">
                    <option selected disabled>Выберите срок оплаты</option>
                    <option value="3">3 месяца</option>
                    <option value="6">6 месяцев</option>
                    <option value="12">12 месяцев</option>
                </select>
                
                {{-- correction text --}}
                @if (isset($message))
                    <h4 class= "bg-danger text-light">{{$message}}</h4>
                @endif
                
                {{-- interface buttons --}}
                <div>
                    <button type="button" class="btn btn-outline-danger" onclick="window.location.href='/main'">Назад</button>
                    <button type="submit" class="btn btn-outline-primary">Перевести</button>
                </div>
            </form>
            
        </div>
    </body>
</html>
