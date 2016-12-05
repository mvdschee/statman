<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mypage</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>My first webpage yeahhh</h1>  
        {{ $title }}<br>
        {{ $subtitle }}<br>
        {{ $food }}<br>

        @if($title =='Home')
            i love it
        @endif

        <ul>
         @foreach($orders as $order)
            <li>{{ $order->name }}</li>
         @endforeach
        </ul>
    </body>
</html>
