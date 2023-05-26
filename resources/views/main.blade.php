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
            h1{
                text-align:center; 
            }
            .interface{
                display: flex;
                justify-content: space-around;
                place-items: center center;
            }
            .account-panel{
                margin: 15% 0;
                width: 40%;
                height: 20%;
                border-radius: 20px;
                padding: 40px;
                color: white;
            }
            .account-panel>div{
                font-size: 2em;
                display: flex;
                justify-content: space-between;
            }
            .account-panel>div>button{
                font-size: 28px;
            }

        </style>
    </head>
    <body>
    
        <h1>Здравствуйте, {{$user['name']}}</h1>
        <div class="interface">
            <div class="account-panel bg-primary ">
                <h2>Счет</h2>
                <div>
                    <div class="bank-account">
                            <p>{{$account['cash']}}</p>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/add-account'">+</button>    
                </div>
                <div>
                    <button class="btn btn-success" type="button" onclick="window.location.href='/transfer'">Перевод средств</button>
                </div>
            </div>


            <div class="account-panel bg-primary ">
                <h2>Задолжность</h2>
                <div>
                    <div class="bank-account" >
                        {{-- <p>{{$loan['sum']}}</p> --}}
                    </div>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/add-loan'">+</button>    
                </div>
                <div>
                    <button class="btn btn-success" type="button" onclick="window.location.href='/debt-repayment'">Погасить задолжность</button>
                </div>
            </div>
        </div>
    </body>
</html>
