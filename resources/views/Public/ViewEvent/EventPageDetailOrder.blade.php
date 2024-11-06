<style>
.button {
  border-radius: 15px;
  background-color: #00f0be;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
  -ms-flex-pack: center;
  justify-content: center;
  padding: calc(.375em - 1px) .75em;
  text-align: center;
  white-space: nowrap;
  font-family: Montserrat,sans-serif;
  transition: all .33s ease;
}
.button.is-primary {
    background-color: #00f0be;
    border-color: transparent;
    color: #fff;
}
.has-text-weight-bold {
    font-weight: 700!important;
}
</style>
<html>
    <body>

        <div style="width:75%; margin:1em auto; height: auto; border: 1px solid lightgrey;">
            <div style="width:70%; margin:0 auto; padding: 3em 0">
            
            <a href=config('app.front_url')."" class="button">volver</a>

                <div style="width:100%">
                    <div style=" width:40%; margin: 0 auto">
                        <img src="{{ asset('images/logo.png') }}" width="100%"/>
                    </div>
                </div>
                @if($status == 'APPROVED')
                    <div style="display:block;">
                        <H2 style="text-align:center">Su pago ha sido APROBADO. ¡Muchas gracias por su compra!</H2>
                    </div>
                @endif
                @if($status == 'REJECTED')
                    <div style="display:block;">
                        <H3 style="text-align:center">Su pago no ha podido ser procesado. Por favor ponganse en contacto con su entidad financiera he intentelo más tarde</H3>
                    </div>
                @endif
                @if($status == 'PENDING')
                    <div style="display:block;">
                        <p style="text-align:center">En este momento su compra con referencia <b>{{$reference}}</b>, presenta un proceso de pago cuya transacción se 
                        encuentra <b>PENDIENTE</b> de recibir confirmación por parte de su entidad financiera, 
                        por favor espere unos minutos y vuelva a consultar más tarde para verificar si su pago fue confirmado de forma exitosa. 
                        Si desea mayor información sobre el estado actual de su operación puede un correo electrónico a <b>pagos@mocionsoft.com</b>
                        y preguntar por el estado de la transacción.</p>
                    </div>
                @endif                  
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:100%;">
                            <h3 style="margin: 0; text-align:center">Estado de la compra</h3>
                            @if($status == 'APPROVED')
                                <H3 style="color:GREEN; margin: 0 0 0 1em; text-align:center">APROBADA</H3>
                            @elseif($status == 'REJECTED')
                                <H3 style="color:RED; margin: 0 0 0 1em; text-align:center">RECHAZADA</H3>
                            @elseif($status == 'CANCELLED')
                                <H3 style="color:RED; margin: 0 0 0 1em; text-align:center">CANCELADO</H3>
                            @elseif($status == 'PENDING')
                                <H3 style="color:F1B203; margin: 0 0 0 1em; text-align:center">PENDIENTE</H3>
                            @elseif($status == 'FAILED')
                                <H3 style="color:RED; margin: 0 0 0 1em; text-align:center">FALLIDO</H3>
                            @endif
                        </div>
                    </div>
                <br>
                <div style="display: block; border-bottom: 1px solid lightgrey;">
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:45%;">
                            <h3 style="margin: 0;">Nombre</h3>
                            <p style="margin: 0 0 0 1em;">{{$order_name}}</p>
                        </div>
                        <div style="display: inline-block; margin-bottom:1em; width:45%; float: right;">
                            <h3 style="margin: 0;">Apellido</h3>
                            <p style="margin:0 0 0 1em;">{{$order_lastname}}</p>
                        </div>
                    </div>
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:45%;">
                            <h3 style="margin: 0;">Email</h3>
                            <p style="margin: 0 0 0 1em;">{{$order_email}}</p>
                        </div>
                        <div style="display: inline-block; margin-bottom:1em; width:45%; float: right;">
                            <h3 style="margin: 0;">Referencia</h3>
                            <p style="margin:0 0 0 1em;">{{$reference}}</p>
                        </div>
                    </div>  
                    @if(isset($payment))
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:45%;">
                            <h3 style="margin: 0;">Total</h3>
                            <p style="margin: 0 0 0 1em;">{{$order_total}}.
                                {{$amount->currency()}}
                           </p>
                        </div>
                        <div style="display: inline-block; margin-bottom:1em; width:45%; float: right;">
                            <h3 style="margin: 0;">Fecha</h3>
                            <p style="margin:0 0 0 1em;">{{$today}}</p>
                        </div>
                    </div>
                    @if($payment != '')
                    <div style="display:block;">
                        <h3 style="margin: 0;">Descripción:</h3>
                        
                            <p style="text-align:center">{{$payment->description()}}</p>
                        
                    </div>
                    @endif
                    @else
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:45%;">
                            <h3 style="margin: 0;">Total</h3>
                            <p style="margin: 0 0 0 1em;">{{$order_total}}.{{$currency}}</p>
                        </div>
                        <div style="display: inline-block; margin-bottom:1em; width:45%; float: right;">
                            <h3 style="margin: 0;">Fecha</h3>
                            <p style="margin:0 0 0 1em;">{{$today}}</p>
                        </div>
                    </div>
                    <div style="display:block;">
                        <h3 style="margin: 0;">Descripción:</h3>
                        <p style="text-align:center">{{$description}}</p>
                    </div>
                    @endif
                    @if($status == 'APPROVED')
                        <div style="display:block;">
                            <a  href="{{ route('orderCompleted', ['reference' => $reference] )}}" style="text-align:center;" class="button is-primary has-text-weight-bold ">Ver Detalles de la compra</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>

