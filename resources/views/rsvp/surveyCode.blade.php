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
                ¡Muchas gracias por tomarse el tiempo de diligenciar la encuesta!
                El código PDU de la Conferencia {{$survey_name}} es <b>{{$code}}</b>
            </td>
         </tr>
         <tr>
            <td style="text-align: center">
                Nota: Recuerda que el acceso es de uso personal y no podrá ser abierto en dos o mas dispositivo al mismo tiempo.<br>Powered by Evius.co
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
