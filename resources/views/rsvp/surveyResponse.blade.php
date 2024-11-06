@component('mail::message')
<table style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px" align="center">
    <thead>
        <tr>
          <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" 
                        alt="Evius"
                        src={{$image_header}} />  
                </div>
          </td>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:20px;text-align:center;padding:10px;display:block">
                ¡Hola {{$eventUser_name}}! La encuesta <b>{{$survey_name}}</b> ya está disponible. 
                Inicia sesion y respondela mediante el siguiente enlace. Recuerda que el usuario y contraseña es el correo con el que te registraste
                ¡Te esperamos!
            </td>
         </tr>
         <tr>
            <td style="text-align: center">
                @component('mail::button', ['url' => $link])
                    {{-- {{ __('Mail.enter_event')}} --}}
                    Entra AQUÍ
                @endcomponent
                Nota: Recuerda que el acceso es de uso personal y no podrá ser abierto en dos o mas dispositivo al mismo tiempo.<br>Powered by GEN.iality
            </td>
        </tr>			 
        <tr>
            <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" 
                        alt="Evius" 
                        src= {{$image_footer}} />  
                </div>	
            </td>
        </tr>
    </tbody>
</table>
@endcomponent
