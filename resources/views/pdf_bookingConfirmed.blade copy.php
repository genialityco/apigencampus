<style>
    h4.title {
    margin-block-end: 0px;
    margin-block-start: 0px;
}
    td.text {
    text-size-adjust: 12px;
    }
</style>
<html>
    <body>
    @if(isset($eventusers))
    @foreach($eventusers as $eventuser)
        <div style="width:75%; margin:1em auto; height: auto; border: 1px solid lightgrey;">
            <div style="width:70%; margin:0 auto; padding: 3em 0">
                <div style="width:100%">
                    <div style=" width:40%; margin: 0 auto">
                        <img src="images/logo.png" width="100%"/>
                    </div>
                </div>

                <div style="display: block; height: 300px; margin-bottom:1em; border-bottom: 1px solid lightgrey;">
                    <div style="width:40%; display: inline-block; vertical-align:top; padding: 35px 0;">
                        <div style="margin-bottom: 1em;">
                            <h3 style="margin: 0;">Evento</h3>
                            <p style="margin: 0;font-size:14px">{{$event->name}}</p>
                        </div>
                        <div style="margin-bottom: 1em;">
                            <h3 style="margin: 0;">Ticket Nro</h3>
                            <p style="margin: 0;">{{$order->order_reference}}</p>
                        </div>
                        <div style="margin-bottom: 1em;">
                            <h3 style="margin: 0;">Fecha de Impresion</h3>
                            <p style="margin: 0;">{{$today}}</p>
                        </div>
                    </div>
                    <div style="width: auto; display: inline-block;">
                        <img src="{{$eventuser->qr}}" />
                    </div>
                </div>

                <div style="display: block; border-bottom: 1px solid lightgrey;">
                    <div style="display: inline-block; width:100%; margin-bottom: 1em;">
                        <h3 style="margin: 0;">Nombre</h3>
                            <p style="margin: 0; text-align:center">{{$eventuser->properties["names"]}}</p>
                    </div>
                    <div style="display:block; width:100%; margin-bottom: 1em;  ">
                        <div style="display:inline-block; margin-bottom:1em; border-right:1px solid lightgrey; width:45%;">
                            <h3 style="margin: 0;">Tipo de Entrada</h3>
                            @if(!is_null($eventuser->seat))
                                <p style="margin: 0 0 0 0;">{{$eventuser->seat["displayedLabel"]}}</p>
                            @else
                                <p style="margin: 0 0 0 1em;">{{$eventuser->ticket->title}}</p>
                            @endif
                        </div>
                        <div style="display: inline-block; margin-bottom:1em; width:45%; float: right;">
                            @if (isset($event->fees) && $event->comission_on_base_price == true)
                            <?php 
                            $price = $eventuser->ticket->price;
                            $price = number_format($price, 0, '.', '');
                            $fee = $price * $event->fees;
                            $fee = number_format($fee, 0, '.', '');
                            $tax = $fee * $event->tax;
                            $tax = number_format($tax, 0, '.', '');
                            $total = $price + $fee + $tax;
                            $total = number_format($total, 0, '.', '');

                            ?>
                            <table style="margin-left: -23px;">
                                <tr>
                                    <td>
                                        <h4 class="title">Precio base</h4>
                                    </td>
                                    <td>
                                        <h4 class="title" style ="border-left:1px solid lightgrey; margin: 0 0 0 2px;">Comision</h4>
                                    </td>
                                    <td>
                                        <h4 class="title" style ="border-left:1px solid lightgrey; margin: 0 0 0 2px;">IVA</h4>
                                    </td>
                                    <td>
                                        <h4 class="title" style ="margin: 0 0 0 2px;">Total</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text">
                                        {{$price}}
                                    </td>
                                    <td class="text">
                                        {{$fee}}
                                    </td>
                                    <td class="text">
                                        {{$tax}}
                                    </td>
                                    <td class="text">
                                        {{$total}}
                                    </td>
                                </tr>
                            </table>
                            @else
                            <h3 style="margin: 0;">Precio</h3>
                            <p style="margin:0 0 0 1em;">{{$eventuser->ticket->price}}</p>
                            @endif
                        </div>
                    </div>                    
                </div>
                @if(!is_null($eventuser->ticket->dates))
                    <div style="display: block; border-bottom: 1px dashed lightgrey;">
                        <div style="display:inline-block; width:100%; margin-bottom:1em;">
                            <div style="display:inline-block; width:45%">
                                <h3>Fechas del Evento</h3>
                                <p>{{$stage}}</p>
                            </div>
                            @if(isset($event->allow_company) && $event->allow_company)
                            <div style="display:inline-block; width:45%">
                                <h3>Acompañantes</h3>
                                <p>{{$eventuser->properties['acompanates']}}</p>
                            </div>
                            @endif
                            <br>
                            <div style="display:inline-block; width:100%">
                                <p style="text-align:center"><b>{{$eventuser->ticket->dates}}</b></p>
                            </div>    
                        </div>
                    </div>
                @elseif(!isset($event->stage_continue))
                    <div style="display:block;">
                        <div style="display: inline-block; width:100%; margin-bottom:1em;">
                            <div style="display: inline-block; margin-bottom: 1em; margin-top: 2em; width: 100%;">
                                <div style="display:inline-block; width:45%; border-right: 1px solid lightgrey;">
                                    <h3 style="margin: 0;">Fecha de Inicio</h3>
                                    <p style="margin:0 0 0 1em;">{{ date('l, F j Y ', strtotime($event->datetime_from)) }}</p>
                                </div>
                                <div style="display:inline-block; width:45%; float: right;">
                                    <h3 style="margin: 0;">Hora</h3>
                                    <p style="margin:0 0 0 1em;">{{date('H:s', strtotime($event->datetime_from)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:block;">
                        <div style="display:inline-block; width:100%; margin-bottom: 1em;">
                            <div style="display:inline-block; margin-bottom: 1em; width: 100%;">
                                <div style="display:inline-block; width:45%; border-right: 1px solid lightgrey;">
                                    <h3 style="margin: 0;">Fecha Finalización</h3>
                                    <p style="margin:0 0 0 1em;">{{ date('l, F j Y ', strtotime($event->datetime_to)) }}</p>
                                </div>
                                <div style="display:inline-block; width:45%; float:right;">
                                    <h3 style="margin: 0;">Hora</h3>
                                    <p style="margin:0 0 0 1em;">{{date('H:s', strtotime($event->datetime_to)) }}</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                @endif
                <div style="display: block; border-bottom: 1px dashed lightgrey;">
                    <div style="display:inline-block; width:100%; margin-bottom:1em;">
                        <div style="display:inline-block; width:100%">
                            <h3>Ubicacion del Evento</h3>
                            <p style="text-align:center"><b>{{$location}}</b></p>
                        </div>    
                    </div>
                </div>

                <div style="display:block;">
                    <p style="text-align:center;font-size:14px">Imprime esta entrada y tráela el día del evento, recuerda
                    que tambien puedes presentarla desde tu smartphone.</p>
                </div>
            </div>
        </div>
        <div style="display:block; width:50%; margin:1em auto;">
            <div style="display:block;">
                <p style="text-align:center">La manera más facíl de publicar y organizar tus eventos.</p>
            </div>
            @if($event->id == '5c3fb4ddfb8a3371ef79bd62')
                <div style="display:block;">
                    <p style="text-align:center;font-size:12px">Responsable <b>Asociación Colombiana de Integración Sensorial</b> (ACIS)</p>
                    <p style="text-align:center;font-size:12px"><b>Mocion NIT. 900324992</b> es un intermediario para la venta de boletería</p>
                </div>
            @endif
            @if($event->id == '5ca5265c3422542c5a146552')
                <div style="display:block;">
                    <p style="text-align:center;font-size:12px">Responsable <b>KALACA PRODUCCIONES SAS NIT 901263157-4</b></p>
                    <p style="text-align:center;font-size:12px"><b>Mocion NIT. 900324992</b> es un intermediario para la venta de boletería</p>
                    <p style="text-align:center;font-size:12px">El costo del servicio y el IVA del servicio estan incluidos en el precio de venta</p>
                </div>
            @endif
            <div style="display:block; width:40%; margin: 0 auto">
                <img src="images/logo.png" width="100%"/>
            </div>
        </div>
    @endforeach
    @endif
    </body>
</html>
