<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/huella2.png')}}" type="image/png">

        <title>Date my pet | Inicio </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .img-ch{
                width: 16px;
            }

            .a-link:hover{
                color:white;
            }

            .title>*{
                display: inline-block;
                vertical-align: middle;
                margin: 0;
            }

           
            .title{
                position: absolute;
                right: 3%;
                bottom: 0;
            }

            .img-logo{
                transform: rotate(20deg);
            }

            .color-wh{
                color:white;
            }
            .bg-pet{
                background: url('{{asset("images/fondo2.jpg")}}');
                background-position-y: center;
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .bg-opacity{
                background: rgba(0, 0, 0, .58)
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="bg-pet">
        <div class="flex-center position-ref full-height bg-opacity">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"> <img src="{{asset('images/huella2.png')}}" class="img-logo img-ch" alt="logo"> Inicio</a>
                    @else
                        <a href="" class="a-link"> <img src="{{asset('images/huella2.png')}}" class="img-logo img-ch" alt="logo"> Ingresar</a>
                        <a href="" class="a-link"> <img src="{{asset('images/huella2.png')}}" class="img-logo img-ch" alt="logo"> Registrarse</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md color-wh">
                  <figure>
                      <img src="{{asset('images/huella2.png')}}" class="img-logo" alt="logo">
                  </figure>
                    <span>Date My pet</span>
                </div>           
            </div>
        </div>
    </body>
</html>
