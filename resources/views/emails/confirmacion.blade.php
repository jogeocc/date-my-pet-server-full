<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <style>
        *{
            margin:0;
            font-size:15px;
         }

        ul{
            list-style-image: url("http://date-my-pet-mx.tk/images/li-icon.png");
         }

        .mi-li>*{
            display: inline-block;
            vertical-align:middle;
            margin: 0.1em 0;
        }
        .mi-li{
            padding-left:0.5em;        
        }

        .titular{
            width:100%;
            display:inline-block;
            background:#49932c;
            background-repeat:no-repeat;
            margin-bottom:0.5em;
        }

        .titular>*{
            display:inline-block;
            vertical-align: middle;
        }

        .titular>h1{
            padding-left: 0.2em;
            font-family: 'Pacifico', cursive;
            font-weight: normal;
            font-size: 2.5em;
            color:#FFB74D;
            
         }

        .contenido{
            padding:0.5em;
        }

    </style>
</head>
<body>
    <div class="titular">
        <img src="http://date-my-pet-mx.tk/images/titular.png" />
    </div>
    <div class="contenido">
        <p>Felicidades! Has creado tu cuenta en DateMyPet con los siguientes datos:</p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Nombre de usuario: {{$usuario->username}}</span></p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Correo: {{$usuario->correo}}</span></p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Nombre: {{$usuario->nombre}}</span></p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Teléfono: {{$usuario->telefono}}</span></p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Celular: {{$usuario->celular}}</span></p>
        <p class="mi-li"><img src="http://date-my-pet-mx.tk/images/li-icon.png"/> <span>Dirección: {{$usuario->direccion}}</span></p>
        <br/>
        <p>Link de activación: <a href="http://date-my-pet-mx.tk/activar/{{$usuario->remember_token}}">http://date-my-pet-mx.tk/activar/{{$usuario->remember_token}}</a></p>
    </div>
</body>
</html>
