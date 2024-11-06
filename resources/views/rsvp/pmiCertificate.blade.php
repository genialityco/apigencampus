@component('mail::message')
    <table
        style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px" align="center">
        <thead>
            <tr>
                <td>
                    <div class="centered">
                        <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" alt="Evius"
                            src={{ $image_header }} />
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:20px;text-align:center;padding:10px;display:block">
                    Gracias por ser parte del IX congreso Internacional de Gerencia de Proyectos, realizado el 30 de
                    septiembre y el 1° de octubre de 2022.
                    <br />
                    <br />
                    Adjunto encontrarás tu certificado de asistencia. Así mismo queremos brindarte este enlace donde
                    encontrarás todas las memorias de nuestro evento. 
                </td>
            </tr>
            <tr>
                <td class="text-align: center">
                    @component('mail::button', ['url' => $link , 'color' => 'evius'])
                        Memorias del evento
				    @endcomponent
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    Powered by Evius.co
                </td>
            </tr>
            <tr>
                <td>
                    <div class="centered">
                        <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="Evius"
                            src={{ $image_footer }} />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endcomponent
