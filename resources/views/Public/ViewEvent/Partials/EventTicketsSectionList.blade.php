
<!-- EN ESTE LUGAR SE CARGA EL TITULO CADA UNO DE LOS TABS-->
<!-- Si el stage esta en las fechas correspondientes se coloca la clase active-->
@if(isset($stages))
<div class="tab" style="font-family:Montserrat,sans-serif">
<ul class="nav">
    <div class="row" style="background-color: #8080800a">

    
    @foreach($stages as $key => $stage) 
    <div class="col-sm-3">
        <!-- aca verificamos si el stage esta activo dentro de las fechas -->
        @php $class_tab_active = ($key == $stage_act) ? 'active': ''; @endphp
        <li class="nav-item">
        <a class="nav-link" onclick="openCity(event, '{{$key}}')" style="font-family:Montserrat,sans-serif">   
            @if(is_null($event->stage_continue))
            <p class="{{$class_tab_active}} tab-{{$key}}">
                {{$stage['title']}} <br>
                <small style="font-size: 1rem;">
                    Desde: {{$event->stage_continue}} <?php echo date('d F', strtotime($stage["start_sale_date"])); ?>
                </small> <br>
                 <small style="font-size: 1rem;">
                    Hasta: <?php echo date('d F Y', strtotime($stage["end_sale_date"])); ?>
                </small>
            </p>
            @else
            <p class="{{$class_tab_active}} tab-{{$key}} calender">
                {{$stage['title']}} <br>
            </p>
            @endif
            
        </a>
        </li>
    </div>
    @endforeach
    </div>
</ul>
</div>

<!-- EN ESTE LUGAR SE CARGA LA INFORMACIÓN DE CADA UNO DE LOS TABS-->
<!-- Si el stage esta en las fechas correspondientes se coloca los estilos para visualizar el tab-->
@foreach($stages as $key => $stage) 

    @php $styles_tab_active = ($key == $stage_act) ? 'display: block': 'display: none';  @endphp
    <div id="{{$key}}" class="tabcontent" style="{{$styles_tab_active}}" >
    @if($tickets->count() > 0)

        {!! Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']) !!}

            <div class="col-md-12">
                    <div class="content">
                        <div class="tickets_table_wrap">
                        @if(isset($event->codes_discount))
                            <div id="codes_discount">                          
                            </div>
                        @endif
                            <table class="table">
                                <?php
                                $is_free_event = true;
                                ?>
                                @foreach($tickets as $ticket)
                                    @if($ticket->stage_id == $stage["stage_id"])
                                    <tr class="ticket" property="offers" typeof="Offer" >
                                        <td class="td" >
                                            <span class="ticket-title semibold" property="name">
                                                {{$ticket->title}}
                                            </span>
                                            <p class="ticket-descripton mb0 text-muted" property="description">
                                                {{$ticket->description}}
                                            </p>
                                        </td>
                                        <td class="td precio">
                                            <div class="ticket-pricing">
                                                @if($ticket->is_free)
                                                    @lang("Public_ViewEvent.free")
                                                    <meta property="price" content="0">
                                                @else
                                                    
                                                    <?php
                                                    $is_free_event = false;
                                                    ?>
                                                    <span title='{{money($ticket->price, $event->currency)}} @lang("Public_ViewEvent.ticket_price") + {{money($ticket->total_booking_fee, $event->currency)}} @lang("Public_ViewEvent.booking_fees")'>{{money($ticket->total_price, $event->currency)}} </span>
                                                    {{--  <span class="tax-amount text-muted text-smaller">{{ ($event->organiser->tax_name && $event->organiser->tax_value) ? '(+'.money(($ticket->total_price*($event->organiser->tax_value)/100), $event->currency).' '.$event->organiser->tax_name.')' : '' }}</span> --}}
                                                    <meta property="priceCurrency"
                                                        content="{{ $event->currency->code }}">
                                                    <meta property="price"  
                                                        content="{{ number_format($ticket->price, 2, '.', '') }}">
                                                    {{$ticket->currency}}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td cantidad">
                                            @if($ticket->is_paused)

                                                <span class="text-danger">
                                                    @lang("Public_ViewEvent.currently_not_on_sale")
                                                </span>

                                                    @else

                                                    @if($ticket->sale_status === config('attendize.ticket_status_sold_out'))
                                                        <span class="text-danger" property="availability" content="http://schema.org/SoldOut">
                                                    @lang("Public_ViewEvent.sold_out")
                                                </span>
                                                    @elseif($ticket->sale_status === config('attendize.ticket_status_before_sale_date'))
                                                                    <span class="text-danger">
                                                    @lang("Public_ViewEvent.sales_have_not_started")
                                                </span>
                                                    @elseif($ticket->sale_status === config('attendize.ticket_status_after_sale_date'))
                                                        <span class="text-danger">
                                                    @lang("Public_ViewEvent.sales_have_ended")
                                                </span>
                                                @else
                                                    {!! Form::hidden('tickets[]', $ticket->id) !!}
                                                    <meta property="availability" content="http://schema.org/InStock">
                                                    @if($key >= $stage_act)
                                                        <select name="ticket_{{$ticket->id}}" class="form-control tickets"
                                                                style="text-align: center; border-bottom: solid 3px #00f0be;">
                                                            @if ($tickets->count() > 1)
                                                                <option value="0">0</option>
                                                            @endif
                                                            @for($i=$ticket->min_per_person; $i<=$ticket->max_per_person; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    @endif
                                                @endif

                                            @endif
                                        </td>
                                    </tr>
                                    <!-- este tr es para dar espacio entre las celtas -->
                                    <tr class="espacio">
                                        <td class="espacio"></td>
                                    </tr>
                                    @endif
                                @endforeach
                                
                                    <tr>
                                        <td colspan="3" style="text-align: center">
                                        @if(Auth::user())
                                            @lang("Public_ViewEvent.below_tickets")
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(isset($event->tickets_discount) && $event->tickets_discount != 0)
                                        <td  colspan="3" style="text-align: center;">
                                        <div class="alert alert-success" role="alert" style="background-color: #3273dc !important; color: white !important">
                                            Recibe el <b>{{$event->percentage_discount}}% </b> de descuento en el total de tu compra, al momento de seleccionar más de <b>{{$event->tickets_discount}}</b> tiquetes para el evento
                                        </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr class="checkout">
                                        <td colspan="3">
                                            @if(!$is_free_event)
                                                <div class="">
                                                
                                                    @if($event->enable_offline_payments)
                                                        
                                                        <div class="help-block" style="font-size: 11px;">
                                                            @lang("Public_ViewEvent.offline_payment_methods_available")
                                                        </div>
                                                    @endif
                                                </div>

                                            @endif
                                            @if(Auth::user())
                                                {!!Form::submit(trans("Public_ViewEvent.register"), ['class' => 'button-purchase'])!!}
                                            @endif
                                            
                                        </td>
                                    </tr>
                            </table>
                        </div>
                </div>
            </div>
            {!! Form::hidden('is_embedded', $is_embedded) !!}
            {!! Form::close() !!}
           
    </div> 
    @else
        <div class="alert alert-boring">
            @lang("Public_ViewEvent.tickets_are_currently_unavailable")
        </div>
    @endif          
@endforeach
@else
    <span class="text-danger">
        @lang("Public_ViewEvent.sales_have_not_started")
    </span>
@endif 