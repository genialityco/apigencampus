<!-- EN ESTE LUGAR SE CARGA EL TITULO CADA UNO DE LOS TABS-->
<!-- Si el stage esta en las fechas correspondientes se coloca la clase active-->
@if(isset($stages))
<div id="ticket-selection" style="height: 100%;">
<div class="tab-navigation ">
<h3 style="text-align:center"> Fecha </h3>
    <p class= "help-text"> Elija el día de su reserva </p>
    <select id="select-box" class="etapa dropdown-tickets">
    <option value="" selected> Seleccione ...</option>   
    @foreach($stages as $key => $stage)
    @if ($stage['stage_id'] != 1555977610)
      <option value="{{$key}}" {{$key==0?"selected":""}}>
        <p class="tab-{{$key}}">{{$stage['title']}}</p>
      </option>
    @endif
    @endforeach
    </select>
  </div>
<!-- EN ESTE LUGAR SE CARGA LA INFORMACIÃ“N DE CADA UNO DE LOS TABS-->
<!-- Si el stage esta en las fechas correspondientes se coloca los estilos para visualizar el tab-->
@foreach($stages as $key => $stage)
    @php $styles_tab_active = ($key == $stage_act) ? 'display: block': 'display: none';  @endphp
    <div id="{{$key}}" class="tabcontent" style="{{$styles_tab_active}}" >
    @if($tickets->count() > 0)
        {!! Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
            <div class="">
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

                                    <h3 class="title">Hora</h3>
                                    <p class= "help-text"> Elija la hora que desee </p>
                                    <select  id="ticket-type-selection" class="ticket-type dropdown-tickets" >  
                                            <option value="" selected> Seleccione ...</option>                          
                                    @foreach($tickets as $ticket)

                                        @if($ticket->stage_id != $stage["stage_id"]) @continue @endif
                                            <option value="{{ $ticket->id }}"> {{ $ticket->title }} </option>
                                    @endforeach
                                    </select>
                                    <div  style="display: none">
                                    @foreach($tickets as $ticket)
                                        @if($ticket->stage_id != $stage["stage_id"]) @continue @endif
                                        <!-- Como validamos la cantidad y enviamos la información por hora-->
                                        <div>
                                            {!! Form::hidden('tickets[]', $ticket->id) !!}
                                            <select id="ticket_{{ $ticket->id }}" name="ticket_{{ $ticket->id }}" class=" ticket_dropdown dropdown-tickets">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                            </select>
                                        </div>
                                    @endforeach
                                    </div>
                                    <tr>
                                        <td colspan="3" style="text-align: center">
                                        @if(Auth::user())
                                            Selecciona la fecha y la hora para la reserva
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(isset($event->tickets_discount) && $event->tickets_discount != 0)
                                        <td  colspan="3" style="text-align: center;">
                                        <div class="alert alert-success" role="alert" style="background-color: #3273dc !important; color: white !important">
                                            Recibe el <b>{{$event->percentage_discount}}% </b> de descuento en el total de tu compra, al momento de seleccionar mÃ¡s de <b>{{$event->tickets_discount}}</b> tiquetes para el evento
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
                                        </div>
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
</div>