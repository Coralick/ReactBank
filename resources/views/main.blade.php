<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-Header/>
    <body>
        <h1>Здравствуйте, {{$user['name']}}</h1>
        <div class="interface">

            {{-- accounts interface --}}
            <div class="section">
                <div class="bg-primary panel "> 
                    <div class="panel">
                        <h1>Счет:</h1>
                        <h1>{{$account['cash']}}руб</h1>
                    </div>
                    <button class="btn btn-success " type="button" onclick="window.location.href='/transfer'">Перевод средств</button>
                </div>
                
            </div>

            {{-- loans interface --}}
            <div class="section">

                <div class="title">
                    <h2>Займы</h2>  
                    @if(count($loanList)<= 2)
                        <button type="button" class="btn btn-primary" onclick="window.location.href='/add-loan'">+</button>
                    
                    @endif

                    @if($loanList)
                        <button type="button" class="btn btn-success"  onclick="window.location.href='/close-loan'">Погасить задолжность</button>
                    @endif
                </div>
                <hr>
                <div class="background-list">
                    @if (isset($loanList))
                    @foreach ($loanList as $loan)
                        <div class="panel bg-primary "> 
                            <h1>{{$loan['sum']}}руб</h1>
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
