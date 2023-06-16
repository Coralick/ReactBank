<?php

?>
<html lang="en">
<x-Header/>
<body>
    <form action="{{ route('close-loan.check')}}" method="post" class="formStyle">
        <h1>Перевод</h1>
    @csrf
    <input type="text" placeholder="денежная сумма" name="amountMoney">
    <select>
        @foreach ($loansList as $loan)
            <option value={{$loan['id']}}>{{$loan['price']}}</option>
        @endforeach
    </select>
    @if (isset($message))
        <h4 class="text-danger">{{$message}}</h4>
    @endif
    <div>
        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='/main'">Назад</button>
        <button type="submit" class="btn btn-outline-primary">Погасить</button>
    </div>
</form>
</body>
</html>