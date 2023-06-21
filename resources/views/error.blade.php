<!DOCTYPE html>
<html lang="en">
    <x-Header/>
<body>
    @if (isset($message))
        <h1 class="text-danger">{{$message}}</h1>
    @endif
    <button class="btn btn-primary" onclick="window.location.href='/'"><-- Назад</button>
</body>
</html>