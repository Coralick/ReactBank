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
                width: 100%;
                justify-content: space-around;
            }
            .accounts, .loans{
                width: 100%;

            }
            .accounts-list, .loan-list{
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                place-content: center center;
                align-items: center;

            }
            .account-panel, .loan-panel{
                margin: 20px 0;
                display: flex;
                justify-content: space-evenly;
                width: 50%;
                height: 25%;
                border-radius: 20px;
                padding: 40px;
                color: white;
            }
            .account-panel>div, .loan-panel>div{
                font-size: 2em;
                display: flex;
                justify-content: space-between;
            }
            .account-panel>button, .loan-panel>button{
                font-size: 15px;
            }   
            .title{
                display: flex;
                justify-content: space-around
            }
        </style>
    </head>
    <body>
        <h1>Здравствуйте, {{$user['name']}}</h1>
        <div class="interface">

            {{-- accounts interface --}}
            <div class="accounts">
                <div class="title">
                    <h2>Счета</h2>  
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/add-account'">+</button>
                </div>
                <div class="accounts-list">
                    @if (isset($accountList))
                    @foreach ($accountList as $account)
                        <div class="account-panel bg-primary "> 
                            <h1>{{$account['cash']}}руб</h1>
                            <button class="btn btn-success " type="button" onclick="window.location.href='/transfer'">Перевод средств</button>
                        </div>
                    @endforeach
                    @else
                        <h2>У вас нет счетов</h2>
                    @endif
                </div>
            </div>

            {{-- loans interface --}}
            <div class="loans">
                <div class="title">
                    <h2>Займы</h2>  
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/add-loan'">+</button>
                </div>
                <div class="loan-list">
                    @if (isset($loanList))
                    @foreach ($loanList as $loan)
                        <div class="loan-panel bg-primary "> 
                            <h1>{{$loan['sum']}}руб</h1>
                            <button class="btn btn-success " type="button" onclick="window.location.href='/close-loan'">Погасить задолжность</button>
                        </div>
                    @endforeach
                    @else
                        <h2>У вас нет займов</h2>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
