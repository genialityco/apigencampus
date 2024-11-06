@extends('Shared.Layouts.Master')

@section('title')
    @parent
    @lang("Ticket.event_tickets")
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-ticket mr5"></i>
    @lang("Ticket.event_tickets")
@stop

@section('head')
    <script>
        $(function () {
            $('.sortable').sortable({
                handle: '.sortHandle',
                forcePlaceholderSize: true,
                placeholderClass: 'col-md-4 col-sm-6 col-xs-12',
            }).bind('sortupdate', function (e, ui) {

                var data = $('.sortable .ticket').map(function () {
                    return $(this).data('ticket-id');
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUpdateTicketsOrder' ,['event_id' => $event->id]) }}',
                    dataType: 'json',
                    data: {ticket_ids: data},
                    success: function (data) {
                        showMessage(data.message);
                    },
                    error: function (data) {
                        showMessage(lang("whoops2"));
                    }
                });
            });
        });
    </script>
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_header')
    <div class="col-md-9">
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-responsive">
                <button data-modal-id='CreateTicket'
                        data-href="{{route('showCreateTicket', array('event_id'=>$event->id))}}"
                        class='loadModal btn btn-success' type="button"><i class="ico-ticket"></i> @lang("Ticket.create_ticket")
                </button>
            </div>
            @if(false)
                <div class="btn-group btn-group-responsive ">
                    <button data-modal-id='TicketQuestions'
                            data-href="{{route('showTicketQuestions', array('event_id'=>$event->id))}}" type="button"
                            class="loadModal btn btn-success">
                        <i class="ico-question"></i> @lang("Ticket.questions")
                    </button>
                </div>
                <div class="btn-group btn-group-responsive">
                    <button type="button" class="btn btn-success">
                        <i class="ico-tags"></i> @lang("Ticket.coupon_codes")
                    </button>
                </div>
            @endif
        </div>
        <!--/ Toolbar -->
    </div>
    <div class="col-md-3">
        {!! Form::open(array('url' => route('showEventTickets', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')) !!}
        <div class="input-group">
            <input name='q' value="{{$q or ''}}" placeholder="@lang("Ticket.search_tickets")" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
        </span>
            {!!Form::hidden('sort_by', $sort_by)!!}
        </div>
        {!! Form::close() !!}
    </div>
    <hr>
    <div class="col-md-3 col-xs-6">
        <div class="btn-group btn-group-responsive">
            <button data-modal-id='CreateStage'
                    data-href="{{route('showCreateStage', array('event_id'=>$event->id))}}"
                    class='loadModal btn btn-success' type="button"><i class="ico-ticket"></i> @lang("Ticket.create_stage")
            </button>
        </div>
    </div>
@stop

@section('content')
    @if($tickets->count())
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class='order_options'>
                    <span class="event_count">@lang("Ticket.n_tickets", ["num"=>$tickets->count()])</span>
                </div>
            </div>
            <div class="col-md-2 col-xs-6 col-md-offset-7">
                <div class='order_options'>
                    {!! Form::select('sort_by_select', $allowed_sorts, $sort_by, ['class' => 'form-control pull right']) !!}
                </div>
            </div>
        </div>
    @endif
    @if($stages)
        @if(sizeof($stages) > 0)
            @foreach($stages as $stage)
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                            <div class='order_options'>
                                <div style="cursor: pointer;" data-modal-id='stage-{{ $stage["stage_id"] }}'
                                    data-href="{{ route('showUpdateStage', ['event_id' => $event->id, 'stage_id' => $stage['stage_id']]) }}"
                                    class="panel-heading loadModal">
                                <h3>{{$stage["title"]}}</h3>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2 col-xs-6 col-md-offset-7">
                        <div class='order_options'>
                                <p class="nm text-muted">{{$stage["start_sale_date"]}} / {{$stage["end_sale_date"]}}</p>
                        </div>
                    </div>
                </div>
                    <hr>
                <!--Start ticket table-->
                <div class="row sortable">
                @if($tickets->count())
                <!-- START panel -->
                <div class="panel">
                    <div class="table-responsive ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="color: #008d96">
                                        Nombre del tiquete
                                    </th>
                                    <th style="color: #008d96">
                                        Precio
                                    </th>
                                    <th style="color: #008d96">
                                        Vendidos
                                    </th>
                                    @if(isset($event->allow_company))
                                    <th style="color: #008d96">
                                        Total Personas
                                    </th>
                                    @endif
                                    <th style="color: #008d96">
                                        Restantes
                                    </th>
                                    <th style="color: #008d96">
                                        Ingresos
                                    </th>
                                    <th style="color: #008d96">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                @if($ticket->stage_id == $stage["stage_id"])
                                <tr>
                                    <td style="cursor: pointer;" data-modal-id='ticket-{{ $ticket->id }}'
                                    data-href="{{ route('showEditTicket', ['event_id' => $event->id, 'ticket_id' => $ticket->id]) }}"
                                    class="panel-heading loadModal">
                                    @if($ticket->is_hidden)
                                        <i title="@lang('Ticket.this_ticket_is_hidden')"
                                            class="ico-eye-blocked ticket_icon mr5 ellipsis"></i>
                                    @else
                                        <i class="ico-ticket ticket_icon mr5 ellipsis"></i>
                                    @endif
                                    {{$ticket->title}}
                                    </td>
                                    <td>
                                        {{ ($ticket->is_free) ? trans("Order.free") : money($ticket->price, $event->currency) }}
                                    </td>
                                    <td>
                                        @if($ticket->quantity_sold)
                                                {{ $ticket->quantity_sold }}
                                        @else
                                            <p style="color: #c3b3b3;">
                                                0
                                            </p>
                                        @endif
                                    </td>
                                    @if(isset($event->allow_company))
                                    <td>
                                        @if($ticket->total_people_quantity=== null)
                                            <p style="color: #c3b3b3;">
                                                0
                                            </p>
                                        @else
                                            {{ $ticket->total_people_quantity }}
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        @if( $ticket->quantity_remaining=== null)
                                            <p style="color: #c3b3b3;">
                                                0
                                            </p>
                                        @else
                                            {{  $ticket->quantity_remaining }}
                                        @endif
                                    </td>
                                    <td>
                                        {{money($ticket->sales_volume + $ticket->organiser_fees_volume, $event->currency)}}
                                    </td>
                                    <td>
                                    <a style="cursor: pointer;" data-modal-id='ticket-{{ $ticket->id }}'
                                    data-href="{{ route('showEditTicket', ['event_id' => $event->id, 'ticket_id' => $ticket->id]) }}"
                                    class="panel-heading loadModal"><i class="ico-eye"></i></i></a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                    @else
                    @if($q)
                        @include('Shared.Partials.NoSearchResults')
                    @else
                        @include('ManageEvent.Partials.TicketsBlankSlate')
                    @endif
                    @endif
                </div><!--/ end ticket table-->
            @endforeach 
        @endif
    @endif   
@stop
