<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/huella2.png')}}" type="image/png">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>Date my pet | Historial Médico </title>
        
        <meta name="description" content="Bienvenidos a date my pet una solución para llevar el control de las citas medicas de su mascota">

       <!-- Styles -->
        <style>

            *{
                margin:0;
            }

            body{
                min-height:90vh;
                padding-bottom:0.5em;
                background:url({{asset('images/fondohis.png')}});  
            }

            #cabezera{
             }

            #hora{
                text-align:right;
                background:#eee;
                padding:0.5em;
            }

            .izq{
                float:left;
            }

            .der{
                float:right;
            }

            .limpio{
               clear:both;
            }

            #contenedor{
                width:85%;
                margin:auto;    
                background:#FFF;
                height:100%;        
            }

            .cont-figure{
                width:2.5em;            
            }

            .titulo{
                padding:1em;            
            }

            .margen{
                margin-right:1em;            
            }

            .cuerpo{
                margin: 1em 0;            
            }

            .container{
                width:100%;  
                padding-right:1em;          
            }

            .titulo-h1{
                margin:0;            
            }

            .thead{
                background:seagreen;
                color:#FFF;
                 border:3px #FFB74D dashed;
            }

            .fecha-tabla{
                border-top:3px #000 dashed;     
                border:3px #000 dashed;
                text-align:right;            
            }

            .vacio-tr{
                border-bottom:3px #000 dashed;                
            }

            #nombreAnimal{
                text-transform: capitalize;
            }


            @media only screen and (max-width: 768px) {

                #contenedor{
                    width:95%;   
                }

               
                .descripcion{
                   width: 100%;
                    height: 10em;
                    margin: 0;
                    padding: .2em;
                    overflow: scroll;              
                }

                .titulo-h1{
                    font-size: 1.6em;                
                }
                
                .cont-figure{
                    width:2em;                  
                }

            }

        </style>
    </head>
    <body>
     <div id="hora"> <b>{{\Carbon\Carbon::now()->format('d/m/Y h:i:s A')}}</b></div>
        <div id="contenedor">
            <div id="cabezera">           
            <div class="titulo">
            <figure class="izq cont-figure margen">
                <img class="cont-figure" src="{{asset('images/huella2.png')}}"/>            
            </figure>
            
            <h1 class="izq titulo-h1">
                Historial Médico De <span id="nombreMascota">{{$mascota->masNombre}} </span>             
            </h1>
            </div>
            <div class="limpio"></div>
            <div class="cuerpo">
               <div class="container">
                   <table class="table">
                      <thead>
                        <tr class="thead">
                          <th>Percance</th>
                          <th>Atendió</th>
                          <th>Descripción</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($registros as $registro)
                            <tr>
                              <th class="fecha-tabla" colspan="3">Fecha: {{\Carbon\Carbon::parse($registro->regMedFecha)->format('d/m/Y')}}</th>
                            </tr>
                            <tr>
                              <td><b>{{ $registro->regMedPercanse }}</b></td>
                              <td><b>{{ $registro->veterinario->vetNombre }}</b></td>
                              <td><div class="descripcion">{{ $registro->regMedDescp }}<div></td>
                            </tr>
                            <tr>
                              <th class="vacio-tr" colspan="3"> </th>
                            </tr>
                       @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
    </body>
</html>
