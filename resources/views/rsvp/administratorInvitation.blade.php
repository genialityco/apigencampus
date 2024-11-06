@component('mail::message')
<table style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px" align="center">
    <thead>
        <tr>
          <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" alt="Evius" src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FHeader_Evius_1920x540px%20(1).png?alt=media&token=521a9303-f274-437e-90d6-bb887761e13f" />  
                </div>
          </td>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:20px;text-align:center;padding:10px;display:block"> 
                ¡Hola {{$names}} te han designado como administrador!
            </td>
         </tr>
        <tr>
            <td style="text-align: center">
                @component('mail::button', ['url' => $link])
                    {{-- {{ __('Mail.enter_event')}} --}}
                    Entra AQUÍ
                @endcomponent
                Nota: Recuerda que el acceso es de uso personal y no podrá ser abierto en dos o mas dispositivo al mismo tiempo.
            </td>
        </tr> 				 
        <tr>
            <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="Evius" src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FFooter_Evius_1920x200px%20(1).png?alt=media&token=5216761a-b9b2-41e5-8552-5dcbc2a61c7a"/>  
                </div>	
            </td>
        </tr>
    </tbody>
</table>
@endcomponent
