<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-Header/>
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
                    <h4 class="text-danger">{{$message}}</h4>
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
