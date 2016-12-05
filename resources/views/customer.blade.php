<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Customer details</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>

        <!--

        Model(Aansturen hiervan) -> Controller(PHP CODE ) -> View (Front-end)
        
        -->

        <h1>Customer details</h1>  
        <h1> {{ $customer->name; }}</h1>

        <ul>
        @foreach($customer->orders as $order)
            <li> {{ $order->name }} </li>
        @endforeach
        </ul>

    </body>
</html>
