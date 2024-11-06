<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            @lang("Public_ViewEvent.order_details")
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            @lang("Public_ViewEvent.below_order_details_header")
        </div>
        <div class="col-md-4 col-md-push-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-cart mr5"></i>
                        @lang("Public_ViewEvent.order_summary")
                    </h3>
                </div>

                <div class="panel-body pt0">
                    <table class="table mb0 table-condensed">
                        @foreach($tickets as $ticket)
                            <?php
                                $multiple = isset($ticket['ticket']['number_person_per_ticket']) ? $ticket['ticket']['number_person_per_ticket'] : 0;

                                if ($ticket['qty'] > 1) {
                                    $multiple2 = 2;
                                } else {
                                    $multiple2 = 1;
                                }
                                $multiple3 = 0;
                                foreach ($tickets as $ticket) {
                                    $multiple3 = $multiple3 + 1;
                                }
                            ?>
                             <?php
                                if (isset($seats_data)) { 
                                    $seats = $seats_data;
                                    foreach ($seats as $key => $seat) {
                                        if (isset($seat['category'])) {
                                            $seat_category = $seat['category']['label'];
                                            $ticket_name = $ticket['ticket']['title'];
                                            if ($seat_category == $ticket_name) {
                                                $seat_position = $seat['labels']['displayedLabel'];
                                                $seat_title = $seat['labels']['section'];
                                                unset($seats_data[$key]);
                                                break;
                                            }
                                        }
                                    }
                                }
                            ?>
                        @if(isset($event->stage_continue))
                        @foreach($event->event_stages as $stage)
                            @if($stage["stage_id"] == $ticket['ticket']['stage_id'])
                             <b>   Dia: {{$stage["title"]}} </b>
                                @break
                            @endif
                        @endforeach
                        @endif
                        <tr>
                            <td class="pl0">{{{$ticket['ticket']['title']}}} X <b>{{$ticket['qty']}}</b></td>
                            <td style="text-align: right;">
                                @if((int)ceil($ticket['full_price']) === 0)
                                @lang("Public_ViewEvent.free")
                                @else
                                {{ money($ticket['full_price'], $event->currency) }}  
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if ($multiple > 1)
                            <td class="pl0">Personas por ticket X <b>{{$ticket['ticket']['number_person_per_ticket']}}</b></td>
                            @endif
                        </tr>
                        <tr>
                            @if (isset($seats_data))
                            <td class="pl0">{{ $seat_position }}</b></td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach($tickets as $ticket)
                            @if((int)ceil($ticket['full_price']) === 0)
                                <?php $is_free = true;  ?>
                            @else
                                <?php $is_free = false; ?>
                                 @break
                            @endif
                        @endforeach
                    </table>
                </div>
                @if($order_total == 0)
                <div class="panel-footer">
                    @if(isset($discount))
                            <h5 style="text-align: center;">Descuento  del <b>{{$percentage_discount}}%</b> por 
                                @if($code_discount)
                                    el código <b>{{$code_discount}}</b>
                                @else
                                    <b>{{$total_ticket_quantity}}</b> tickets
                                @endif
                            </h5>
                        <h5>
                            Precio: <span style="float: right;"> ${{ number_format($order_total + $discount, 2, '.', '') }} </span>
                        </h5>
                        <h5>
                            Descuento: <span style="float: right;"> - ${{ number_format($discount, 2, '.', '') }} </span>
                        </h5>
                        <hr/>
                    <h5>
                        @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $order_total }}</b></span>
                    </h5>
                    
                    @endif
                </div>
                @endif
                @if($order_total > 0)
                <div class="panel-footer">
                    @if(isset($discount))
                            <h5 style="text-align: center;">Descuento  del <b>{{$percentage_discount}}%</b> por 
                                @if($code_discount)
                                    el código <b>{{$code_discount}}</b>
                                @else
                                    <b>{{$total_ticket_quantity}}</b> tickets
                                @endif
                            </h5>
                        <h5>
                            Precio: <span style="float: right;"> ${{ number_format($order_total + $discount, 2, '.', '') }} </span>
                        </h5>
                        <h5>
                            Descuento: <span style="float: right;"> - ${{ number_format($discount, 2, '.', '') }} </span>
                        </h5>
                        <hr/>

                    @endif
                    @if (isset($event->fees) && !isset($event->comission_on_base_price))
                        <div class="help-block">
                        <h5>
                            Servicio: <span style="float: right;">{{ money($fees_total, $event->currency) }}</span>
                        </h5>
                        </div>
                    @elseif (isset($event->fees) && $event->comission_on_base_price == true)
                        <div class="help-block">
                        <h5>
                            Servicio: <span style="float: right;">{{ money($fees_total, $event->currency) }}</span>
                        </h5>
                        <h5>
                            IVA servicio: <span style="float: right;">{{ money($tax_total, $event->currency) }}</span>
                        </h5>
                        </div>
                    @endif
                    <h5>
                        @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $orderService->getOrderTotalWithBookingFee(true) }}</b></span>
                    </h5>
                    <!-- Esta Parte se encuentra cancelada -->
                    <!-- {{--    @if($event->organiser->charge_tax)
                        <h5>
                            {{ $event->organiser->tax_name }} ({{ $event->organiser->tax_value }}%):
                            <span style="float: right;"><b>{{ $orderService->getTaxAmount(true) }}</b></span>
                        </h5>
                        <h5>
                            <strong>Grand Total:</strong>
                            <span style="float: right;"><b>{{  $orderService->getGrandTotal(true) }}</b></span>
                        </h5>
                        @endif
                    --}} -->
                    <!-- Esta Parte se encuentra cancelada -->

                </div>
                @endif

            </div>
            @if (isset($event->fees) && $event->comission_on_base_price == true)
                <div class="help-block">
                    <strong>El costo del servicio y el IVA del servicio estan incluidos en el precio total</strong>
                </div>
            @endif
            <div class="help-block">
                {!! @trans("Public_ViewEvent.time", ["time"=>"<span id='countdown'></span>"]) !!}
            </div>
        </div>
        <div class="col-md-8 col-md-pull-4">
            <div class="event_order_form">
                {!! Form::open(['url' => route('postCreateOrder', ['event_id' => $temporal_id]), 'class' => ($order_requires_payment && @$payment_gateway->is_on_site) ? 'ajax payment-form' : 'ajax', 'data-stripe-pub-key' => isset($account_payment_gateway->config['publishableKey']) ? $account_payment_gateway->config['publishableKey'] : '']) !!}
                {!! Form::hidden('event_id', $event->id) !!}
                {!! Form::hidden('temporal_id', $temporal_id) !!}
               

                @if(!$is_free)
                <h3> @lang("Public_ViewEvent.your_information_purshase")</h3>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label("order_first_name", trans("Public_ViewEvent.first_name")) !!}
                            {!! Form::text("order_first_name", null, ['required' => 'required', 'class' => 'form-control', 'pattern' => '^[A-Za-z -]+$']) !!}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label("order_last_name", trans("Public_ViewEvent.last_name")) !!}
                            {!! Form::text("order_last_name", null, ['required' => 'required', 'class' => 'form-control', 'pattern' => '^[A-Za-z -]+$']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            {!! Form::label("Document", "Tipo de documento") !!}
                            {!! 
                                Form::select('typeDocument', array(
                                    'CC' => ('Documento de Identidad'),
                                    'TI' => ('TI'),
                                    'PPN'=> ('Pasaporte'),
                                ), null, ['required' => 'required', 'class' => 'form-control']);
                            !!}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            {!! Form::label("document", 'Número del documento') !!}
                            {!! Form::text("document", null, ['required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            {!! Form::label("mobile", 'Teléfono') !!}
                            {!! Form::number("mobile", null, ['required' => 'required', 'class' => 'form-control']) !!}
                            {{ Form::hidden('order_email', $email_user) }}
                        </div>
                    </div>
                </div>
                <!--  Si tiene el rol de caja o administrador, puede generar las ordenes -->
                @if($role == "5c1a59b2f33bd40bb67f2322" || $role == "5cdd8e4f1c9d440000924c98")
                <div class="row" id="box-payment-div">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label("order_email", 'Correo del comprador') !!}
                            {!! Form::text("order_email", $email_user, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="box_payment" id="box-payment" type="checkbox" value="true" checked>
                            <span>Habilitar Caja</span>
                        </div>
                    </div>
                </div>

                @endif

                <div class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!  Form::checkbox('payerIsBuyer', 'true', true) !!}
                            {!! Form::label("payerIsBuyer", "Los datos ingresados anteriormente son de la persona encargada del pago") !!}
                        </div>  
                    </div>
                </div>
                @else
                <h3> @lang("Public_ViewEvent.your_information")</h3>
                <div class="row">
                    <div class="col-xs-2">
                        <b>@lang("Public_ViewEvent.first_name") </b>
                    </div>
                    <div class="col-xs-10">
                        {{Auth::user()->displayName}}
                    </div>
                </div>

                 <div class="row">
                    <div class="col-xs-2">
                        <b> @lang("Public_ViewEvent.email") </b>
                    </div>
                    <div class="col-xs-10">
                        {{Auth::user()->email}}
                    </div>
                </div>
                <br>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!  Form::checkbox('terms', 'true') !!}
                            <a href=config('app.front_url')."/terms" target="_blank">Acepta terminos y condiciones</a>
                        </div>
                    </div>
                </div>

                <div class="p20 pl0" style="display:none">
                    <a href="javascript:void(0);" class="btn btn-primary btn-xs" id="mirror_buyer_info">
                        @lang("Public_ViewEvent.copy_buyer")
                    </a>
                </div>
                    @if ($multiple > 1  || $multiple2 > 1 || $multiple3 > 1 && $event->id != '5c3fb4ddfb8a3371ef79bd62')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!!  Form::radio('holder_info', 'false', 'true') !!}
                                    {!! Form::label("holder_info_attendees", "Asignar las boletas a cada uno de los asistentes") !!}
                                </div>
                                <div class="form-group">
                                    {!!  Form::radio('holder_info', true) !!}
                                    {!! Form::label("holder_info_buyer", "Asignarme las boletas a mi") !!}
                                </div>
                            </div>
                        </div>
                    @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket_holders_details" id="ticket_details" >
                            
                            <?php
                                $total_attendee_increment = 0;
                                if (isset($seats_data)) { 
                                    $seats = $seats_data;
                                    foreach ($seats as $key => $seat) {
                                        if (isset($seat['category'])) {
                                            $seat_title = $seat['category']['label'];
                                        }
                                    
                                    }
                                }
                            ?>
                            
                            @if (isset($seat_title))
                                <H3>{{$seat_title}}</H3>
                            @endif

                            @foreach($tickets as $ticket)
                            <?php
                                $cant = isset($ticket['ticket']['number_person_per_ticket']) ? $ticket['ticket']['number_person_per_ticket'] : $cant;
                                $tot = $ticket['qty'] * $cant;
                            
                              // We compare the seat_category and ticket_name if this is true 
                            //take the seat labe, and break the foreach 
                                if (isset($seats_data)) { 
                                    $seats = $seats_data;
                                    foreach ($seats as $key => $seat) {
                                        if (isset($seat['category'])) {
                                            $seat_category = $seat['category']['label'];
                                            $ticket_name = $ticket['ticket']['title'];
                                            if ($seat_category == $ticket_name) {
                                                $seat_position = $seat['labels']['displayedLabel'];
                                                $seat_title = $seat['labels']['section'];
                                                unset($seats_data[$key]);
                                                break;
                                            }
                                        }
                                    }
                                }
                                ?>
                                @for($i=0; $i<=$tot-1; $i++)
                                <div class="attendize-information">

                                <div class="panel panel-primary">
                                    
                                    <div class="panel-heading">
                                    @if (!isset($seats_data))
                                        <h3 class="panel-title">
                                            <b>{{$ticket['ticket']['title']}}</b>: @lang("Public_ViewEvent.ticket_holder_n", ["n"=>$i+1])  
                                        </h3>
                                    @else
                                        <h3 class="panel-title">
                                            <b>TICKET: {{$seat_position}}-{{$i+1}}</b>
                                        </h3>
                                    @endif
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                        <!-- MODULO PARA CREAR CAMPOS DE TICKETES-->
                                        
                                            @foreach($fields as $field)
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <?php
                                                        $optionns = ["Alimentos","Recreacion o Deporte","Salud o Medicina","Construccion o Infraestructura","Suministros Construccion o Infraestructura","Inmobiliaria","Banca o Finanzas","Gobierno","Defensa","Industria Militar","Organizacion sin ánimo de Lucro","Industria Automotriz","Industria Farmaceutica","Tecnologia","Telecomunicaciones","Otro"]; 
                                                        ?>
                                                    @if(!isset($field['visible']))

                                                        @if(isset( $field['label']))
                                                            {!! Form::label($field['name'], $field['label']) !!}
                                                        @else
                                                            {!! Form::label($field['name'], $field['name']) !!}
                                                        @endif
                                                        
                                                        @if($field['type'] == 'boolean')
                                                                {!! Form::select("tiket_holder_{$field['name']}[{$i}][{$ticket['ticket']['_id']}]",  ['Si','No'], null, ['class' => 'form-control']) !!}
                                                        @elseif($field['type'] == 'list')
                                                            {!! Form::select("tiket_holder_{$field['name']}[{$i}][{$ticket['ticket']['_id']}]", $optionns, null, ['class' => 'form-control']) !!}
                                                        @else
                                                            {!! Form::text("tiket_holder_{$field['name']}[{$i}][{$ticket['ticket']['_id']}]", null, ['class' => 'form-control']) !!}
                                                        @endif
                                                          
                                                    @endif   
                                                  
                                                    </div>

                                                    {{ Form::hidden('ticket_id', $ticket['ticket']['_id']) }}
                                                    @if(isset($ticket['ticket']['number_person_per_ticket']))
                                                        {{ Form::hidden('person_per_ticket', $ticket['ticket']['number_person_per_ticket']) }}
                                                    @endif
                                                </div>
                                            @endforeach
                                            @include('Public.ViewEvent.Partials.AttendeeQuestions', ['ticket' => $ticket['ticket'],'attendee_number' => $total_attendee_increment++])
                                        </div>
                                    </div>


                                </div>
                                </div>
                                @endfor
                            @endforeach
                        </div>
                    </div>
                </div>

                <style>
                    .offline_payment_toggle {
                        padding: 20px 0;
                    }
                </style>

                @if($order_requires_payment)

        
                @if($event->enable_offline_payments)
                    <div class="offline_payment_toggle">
                        <div class="custom-checkbox">
                            <input data-toggle="toggle" id="pay_offline" name="pay_offline" type="checkbox" value="1">
                            <label for="pay_offline">@lang("Public_ViewEvent.pay_using_offline_methods")</label>
                        </div>
                    </div>
                    <div class="offline_payment" style="display: none;">
                        <h5>@lang("Public_ViewEvent.offline_payment_instructions")</h5>
                        <div class="well">
                            {!! Markdown::parse($event->offline_payment_instructions) !!}
                        </div>
                    </div>

                @endif


                @if(@$payment_gateway->is_on_site)
                    <div class="online_payment">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('card-number', trans("Public_ViewEvent.card_number")) !!}
                                    <input required="required" type="text" autocomplete="off" placeholder="**** **** **** ****" class="form-control card-number" size="20" data-stripe="number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    {!! Form::label('card-expiry-month', trans("Public_ViewEvent.expiry_month")) !!}
                                    {!!  Form::selectRange('card-expiry-month',1,12,null, [
                                            'class' => 'form-control card-expiry-month',
                                            'data-stripe' => 'exp_month'
                                        ] )  !!}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    {!! Form::label('card-expiry-year', trans("Public_ViewEvent.expiry_year")) !!}
                                    {!!  Form::selectRange('card-expiry-year',date('Y'),date('Y')+10,null, [
                                            'class' => 'form-control card-expiry-year',
                                            'data-stripe' => 'exp_year'
                                        ] )  !!}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('card-expiry-year', trans("Public_ViewEvent.cvc_number")) !!}
                                    <input required="required" placeholder="***" class="form-control card-cvc" data-stripe="cvc">
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

                @endif

                @if($event->pre_order_display_message)
                <div class="well well-small">
                    {!! nl2br(e($event->pre_order_display_message)) !!}
                </div>
                @endif

               {!! Form::hidden('is_embedded', $is_embedded) !!}
               {!! Form::submit(trans("Public_ViewEvent.checkout_submit"), ['class' => 'btn btn-lg btn-success card-submit', 'style' => 'width:100%;']) !!}

            </div>
        </div>
        @if(!$is_free)
        <div class="col-md-12"><br>
            <a href="https://www.placetopay.com" target="_blank"><img class="" src="{{asset('assets/images/public/EventPage/credit-card-logos.png')}}"/></a>
        </div>
        @endif
    </div>
</section>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif
