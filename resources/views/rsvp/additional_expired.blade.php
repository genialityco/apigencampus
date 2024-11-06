@component('mail::message')
    <table
        style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px"
        align="center">
        <thead>
            <tr>
                <td>
                    <div class="centered">
                        <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" alt="Evius"
                            src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FHeader_Evius_1920x540px%20(1).png?alt=media&token=521a9303-f274-437e-90d6-bb887761e13f" />
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>    
                <td style="font-size:20px;text-align:center;padding:10px;display:block">
                    ¡Hola {{ $name }} te informamos del vencimiento de un adicional!
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;text-align:left;padding:10px;display:block">
                    Fecha de inicio: {{ $start_date }}
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;text-align:left;padding:10px;display:block">
                    Fecha de vencimiento: {{ $end_date }}
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;text-align:left;padding:10px;display:block">
                    Cantidad de usuarios: {{ $amount }}
                </td>
            </tr>
            <tr>
                <td style="font-size:14px;text-align:left;padding:10px;display:block">
                    Ingresa <a href="https://app.evius.co">aquí</a> para disfrutar de tus eventos.
                </td>
            </tr>
            </tr>
            <tr>
                <hr style="border-right : 0;border-left: 0;" />
            </tr>
            <tr>
                <td style="font-size:13px;text-align:left;padding:10px;display:block">
                    Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar, algunas características
                    pueden no estar disponibles en navegadores no soportados
                </td>
            </tr>
            <tr>
                <td style="font-size:13px;text-align:center;padding:10px;display:block">
                    Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al
                    siguiente correo soporte@evius.co
                </td>
            </tr>
            <tr>
                <td>
                    <div class="centered">
                        <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="Evius"
                            src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FFooter_Evius_1920x200px%20(1).png?alt=media&token=5216761a-b9b2-41e5-8552-5dcbc2a61c7a" />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endcomponent
