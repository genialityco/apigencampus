<html>
    <!--    Keep this page lean as possible.-->
    <head>
        <title>
            Ticket(s)
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<style>

</style>

        <style>
@page{
 margin:0px 0px 0px 0px !important;
 padding:0px 0px 0px 0px !important;
}
body{

    background-size:cover;
    height:100%;
    width:100%;
    margin:0;
    padding:0;
    /*font-family: "Verdana", "Geneva","Sans serif","Open Sans", "Titillium","Oswald";*/
   /*font-family:Arial, Helvetica, sans-serif;*/
    }

.imagen{
    width:3300px;
    height:2550px;
    position:fixed;
    top:0px;
    bottom:0px; 
    z-index:-100;       
}



.centre-align {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    width:60%;
    font-size:1em;
    padding-left:7%;
}
.content {
    width: 60%;
    height: 70%;
    background-color: blue;
    display: inline-block;
    vertical-align: middle;
}

        </style>
    </head>
    <body style="background-color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;">
    

    

<div class="containing-table">
    <div class="centre-align">
    <img style="width:90%;heigh:auto" src="https://api.evius.co/images/logoMecLong.png">  
    <h1>¡Bienvenido al Movimiento de Empresarios Creativos!</h1>
<p>
@if (strstr($etapa,"Etapa"))

Tu empresa está en {{ $etapa }}, por ello te invitamos a participar en los espacios diseñados a la
@else

Tu empresa está en etapa de {{ $etapa }}, por ello te invitamos a participar en los espacios diseñados a la
@endif
medida de tus necesidades, para ayudarte a crecer.

Te compartimos el link para que armes tu agenda y vivas la experiencia PowerCamp.
</p>

<p>Visita el siguiente link  <a href="https://meccc.com.co/">www.meccc.com.co</a>
Ingresa con tu usuario y contrasena y podras inscribirte en tus actividades sugeridas
</p>
<p>Tu usuario y contraseña son los siguientes</p> 
<br>


<p>{{ $email}}</p>

<p>{{ $id }}</p>
<br>
<p>¡La zona de registro será en Casa Merced!</p>

<p>Recuerda que también puedes disfrutar el 14 y 15 de noviembre del MECx en el Bulevar del río,
donde habrá exposiciones empresariales, conciertos, casa de arte y más experiencias.</p>

    </div>
</div>
    </body>
</html>