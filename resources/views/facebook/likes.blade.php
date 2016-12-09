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
                    
                    @foreach($data as $post)
                        <a href="http://fb.com/{{$post['id']}}"><h1>{{$post['id']}}</h1></a>
                        Bericht heeft {{$post["likes"]["summary"]["total_count"]}} likes

                        <p>
                            Mensen die geliked hebben:</br>
                            <ul>
                            @foreach($post["likes"]["data"] as $like)
                                <li>{{$like["name"]}}</li>
                            @endforeach
                            </ul>
                        </p>
                    @endforeach


                    <?php
                        dd($data);
                    ?>
                    
                </div>

            </div>
        </div>
    </body>
</html>
*