<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

       
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md"><h1>Facebook</h1></div>

                    
                    
                   @foreach($data as $key => $post)
                        @if(isset($post['message']))
                            @if(isset($post["name"]))
                                <h1>{{$post["name"]}}</h1>
                            @else
                                <h1>{{$post["id"]}}</h1>
                            @endif
                            <p>{{$post['message']}}</p>
                            @if(isset($post['shares']['count']))
                                <p>Aantal shares: {{$post['shares']['count']}}</p>
                            @endif
                            @if(isset($post['likes']['summary']['total_count']))
                                <p>Aantal likes: {{$post['likes']['summary']['total_count']}}</p>
                            @endif
                            @if(isset($post['comments']['data']))
                                <p>Comments:</p>
                                @foreach($post['comments']['data'] as $comment)
                                    <p>{{$comment['from']['name']}}: {{$comment['message']}}</p>
                                @endforeach
                            @endif
                        @endif
                    @endforeach


                    <?php
                        dd($data);
                    ?>
                    
                </div>

            </div>
        </div>
    </body>
</html>