
<style>
    html, body {
        height:100%;
        background:linear-gradient(0deg, rgba(204,250,255,1) 0%, rgba(39,238,252,1) 100%);
    }
    h1 , h3{
        color: rgb(71, 71, 71);
        font-family: "Gill Sans Extrabold", Helvetica, sans-serif;        
    }
    h1{
        font-size: 50px;
    }
    .padre-transform{        
        height: 100vh;
        min-height:600px;
    }
        
    .padre-transform > #naranja{
        position: absolute;
        top:40%;
        left: 50%;
        transform: translate(-50%,-50%);
        max-width: 50%;
        text-align: center;
    }
    .icon-footer{
        height: 50px;
        width: 150x;        
    }
 </style>
<html>
    <head>
        {{-- <link href="{{ asset('../vendor/mail/html/themes/unsubscribe.css')}}" rel="stylesheet">         --}}
        <body>        
                
            <div class="padre-transform">                    
                <div id="naranja">
                    <h1>La suscripción a el evento se ha eliminado</h1>  
                    <h3>Ingresa a <a href="https://evius.co"><?= config('app.name') ?>.co</a> para seguir disfrutando de mÁs eventos</h3>  
                </div>                                                                                
            </div> 
                           
        </body>
    </head>
</html>
