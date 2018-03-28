<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/huella2.png')}}" type="image/png">

        <title>Date my pet | Inicio </title>
        
        <meta name="description" content="Bienvenidos a date my pet una solución para llevar el control de las citas medicas de su mascota">

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

            .img-logo-tit{
                display: none;
            }

            .tituloMsj{
                font-size: 0.8em;
            }

             .btnActivo{
                    font-size:0.4em;
                    background:#27ae60;
                    border: 3px solid seagreen;
                    padding: 20px 15px;
                    border-radius: .5em;
                    font-weight: bold;
                    text-decoration: none;     
            }

             .btnActivo:hover{
                    font-size:0.4em;
                    background:transparent;
                    color: #27ae60;
            }


            a{
                color:white;
            }

            .img-ch{
                width: 16px;
            }

            .a-link:hover{
                color:white;
            }

            .a-link:active{
                color:white;
            }
            .a-link{
                color: #b4b3b0;
            }

            .title>*{
                display: inline-block;
                vertical-align: middle;
                margin: 0;
            }

           
            .title{
                position: absolute;
                right: 3%;
                top: 20%;
            }

            .img-logo{
                transform: rotate(20deg);
            }

            .color-wh{
                color:white;
            }
            .bg-pet{
                background: url('{{asset("images/fondo1.jpg")}}');
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
                color: #b4b3b0;
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

           @media only screen and (max-width: 768px) {

               .bg-pet{
                background: url('{{asset("images/fondo1.jpg")}}');
                background-position-x: center;
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .top-right {
                position: absolute;
                width: 100%;
                right: inherit;
                top: 15px;
            }

               .links{
                   text-align:center;
                  
                
                   
               }

                .a-link{
                    display:inline-block;
                    vertical-align:top;
                    text-align:center;
                    width:30%;
                    color: white;
                }

                .a-link>img{
                    display: block;
                    margin:auto;
                    margin-bottom: .5em; 
                    text-align:center;
                }

                .a-link:first-child>img{
                    display: block;
                    margin-bottom: .6em; 
                }

                .title>*{
                    display: block;
                    margin: auto;
                }

           
                .title{
                    text-align:center;
                    margin:auto;
                    padding: 0 0.5em;
                    position: initial;
                    right: none;
                    top: 0%;
                }

                .btnActivo{
                    font-size:1em;
                    
                }

                .img-logo-tit{
                    display: inline;
                }


            }


@media only screen and (max-width: 400px) {

.top-right {
 position: inherit;
 width: 100%;
 right: inherit;
 top: 15px;
}

.links{
    text-align:center;  
}

 .a-link{
     display:inline-block;
     vertical-align:top;
     text-align:center;
     width:30%;
     color: white;
 }

 .a-link>img{
     display: block;
     margin:auto;
     margin-bottom: .5em; 
     text-align:center;
 }

 .a-link:first-child>img{
     display: block;
     margin-bottom: .6em; 
 }

 .title>*{
     display: block;
     margin: auto;
 }


 .title{
    font-size: 2em;
 }

 .btnActivo{
     font-size:.6em;
     width: 50%;
     display: inline-block;
     
 }

 .btnActivo:hover{
     font-size:.6em; 
 }

 #titulo{
     margin-bottom: .3em;
 }

 .img-logo{
     display: none;
     width: 1em;
 }

}


        </style>
    </head>
    <body class="bg-pet">
        <div class="flex-center position-ref full-height bg-opacity">
            
            <div class="content">
                <div class="title m-b-md color-wh">
                <figure>
                                <img src="{{asset('images/huella2.png')}}" class="img-logo-tit" alt="logo">
                </figure>
                 <span id="titulo">Date My pet</span>
                 @if(activo==1)
                    <span class="tituloMsj">¡Felicidades su activación fue correcta!</span>
                @else
                    <span class="tituloMsj">¡Upps, Hubo un error al activar su cuenta! Si el problema persiste contacte al administrador</span>
                @endif
                    <br>
                  <figure>
                      <img src="{{asset('images/huella2.png')}}" class="img-logo" alt="logo">
                  </figure>
                  @if(activo==1)
                    <a class="btnActivo" href="intent:#Intent;action=com.example.jgchan.datemypet;category=android.intent.category.DEFAULT;category=android.intent.category.BROWSABLE;S.msg_from_browser=Launched%20from%20Browser;end">Presione Aqui para ir a la app</a>
                   
                  @endif
                   <figure>
                      <img src="{{asset('images/huella2.png')}}" class="img-logo" alt="logo">
                  </figure>
                </div>           
            </div>
        </div>
    </body>
</html>
