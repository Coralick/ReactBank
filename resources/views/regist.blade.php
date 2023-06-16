<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-Header/>
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
                @if (isset($message))
                    <h4 class="text-danger">{{$message}}</h4>
                @endif
                <a href="/">У вас уже есть аккаунт? </a>
            </form>
            
        </div>
    </body>
</html>
