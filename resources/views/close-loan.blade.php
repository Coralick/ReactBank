<?php

?>
<html lang="en">
<x-Header/>
<body>
    <form action="{{ route('close-loan.check')}}" method="post" class="formStyle">
        <h1>Погашение</h1>
        <h2 class="bg-primary text-light">Ваш счет:{{$account->cash}}</h2>
    @csrf

    <input type="text" placeholder="денежная сумма" name="amountMoney">
    <select name="id">

        <option disabled selected>Выберите займ</option>

        @foreach ($loansList as $loan)
            <option value={{$loan['id']}}> {{$loan['id']}} - {{$loan->sum}}</option>
        @endforeach

    </select>
    @if (session('message'))
        <h4 class="text-danger">{{session('message')}}</h4>
    @endif
    <div>
        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='/main'">Назад</button>
        <button type="submit" class="btn btn-outline-primary">Погасить</button>
    </div>
</form>
</body>
</html>