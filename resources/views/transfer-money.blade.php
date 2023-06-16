<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <x-Header/>
    <body>

        <div class="block">

            <form action="{{ route('transfer.check')}}" method="post" class="formStyle">
                <h1>Перевод</h1>
                @csrf
                <input type="text" placeholder="номер телефона" name="transferNumber">
                <input type="text" placeholder="денежная сумма" name="amountMoney">

                {{-- get message --}} 
                @if (isset($message))
                    <h4 class="text-danger">{{$message}}</h4>
                @endif

                <div>
                    <button type="button" class="btn btn-outline-danger" onclick="window.location.href='/main'">Назад</button>
                    <button type="submit" class="btn btn-outline-primary">Перевести</button>
                </div>
            </form>
        </div>
    </body>


</html>
