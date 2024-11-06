<div role="dialog"  class="modal fade" style="display: none;">
    <style>
        .well.nopad {
            padding: 0px;
        }
        .modal-body .row{
            margin-top:2rem;
        }
    </style>

    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => route('postOrderEdit', array('order_id' => $order->id)), 'class' => 'ajax reset closeModalAfter')) !!}
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cart"></i>
                    {{ @trans("ManageEvent.edit_order_title", ["order_ref"=>$order->order_reference]) }}
                </h3>
            </div>
            <div class="modal-body">

                <h3>@lang("ManageEvent.order_details")</h3>
                <div class="row">
                    <div class="col-xs-6">
                        <label for="first_name" class="form-control-label">@lang("Attendee.first_name")</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $order->first_name }}">
                    </div>
                    <div class="col-xs-6">
                        <label for="last_name" class="form-control-label">@lang("Attendee.last_name")</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $order->last_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <label for="email" class="form-control-label">@lang("Attendee.email")</label>
                        <input type="text" name="email" class="form-control" value="{{ $order->email }}">
                    </div>
                    <div class="col-xs-6">
                        <label for="status" class="form-control-label">Estado</label>
                        <select class="form-control" name="order_status_id">
                        @foreach($orderStatus as $status)
                            @if($status->_id ==  $order->order_status_id ) 
                                <option value="{{$status->_id}}" selected>{{$status->name}}</option>
                            @else
                                <option value="{{$status->_id}}">{{$status->name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>

                <h3>@lang("ManageEvent.tickets_details")</h3>


                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket_holders_details" >
                            
                            <?php
                                $total_attendee_increment = 0;
                            ?>
                            @foreach($tickets as $index => $ticket)
                                <h4>@lang("Public_ViewEvent.ticket_holder_information") {{$index+1}}</h4>
                                <div class="row" id="ticket">
                                @foreach($ticket->properties as $idx=>$property)
                                    <div class="col-xs-6">
                                        <label for="{{$idx}}" class="form-control-label">{{$idx}}</label>
                                        <input type="text" name="{{$idx}}_{{$index}}" class="form-control" value="{{$property}}">
                                    </div>                                    
                                @endforeach
                                    <div class="col-xs-6">
                                        <input type="checkbox" name="delete_{{$index}}" value="true">
                                        <label for="delete_{{$index}}" class="form-control-label"> Eliminar</label>
                                    </div> 
                                </div>
                            @endforeach
                        </div>
                        <div class="ticket_holders_details" >
                            <small>
                                <h4 align="center">Asistente nuevo</h4>
                                <small>Este campo solo se debe llenar cuando se agrega un nuevo asistente</small>
                                <div class="row">
                                    @foreach($event->first()->user_properties as $property)
                                        <div class="col-xs-4">
                                            <label for="{{ $property['name'] }}" class="form-control-label">{{ $property['name'] }}</label>
                                            <input type="text" name="{{ $property['name'] }}_new" class="form-control" placeholder="ingresa  el dato {{ $property['name'] }} aquí ">
                                        </div>  
                                    @endforeach
                                    <div class="col-xs-4">
                                        <label for="name_tiquet" class="form-control-label">Nombre del tiquete</label>
                                            <select class="form-control" name="ticket_id">
                                            @foreach($tickets_name as $ticket)
                                                    <option value="{{$ticket->_id}}">{{$ticket->title}}</option>
                                            @endforeach
                                            </select>
                                    </div>  
                                </div>
                            </small>
                        </div>

                    </div>
                </div>

            </div> <!-- /end modal body-->



            <div class="modal-footer">
                {!! Form::button(trans("ManageEvent.close"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
                {!! Form::submit(trans("ManageEvent.update_order"), ['class'=>"btn btn-success"]) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /end modal content-->
    </div>
</div>

<script>
    /*
     * -------------------------------------------------------------
     * Simple way for any type of object to be deleted.
     * -------------------------------------------------------------
     *
     * E.g markup:
     * <a data-route='/route/to/delete' data-id='123' data-type='objectType'>
     *  Delete This Object
     * </a>
     *
     */
    $('button.new-tickets-button').on('click', function (e) {
        var valor = $("#ticket")[0];
        $("#new-ticket").append($(valor));     
        console.log("Im here")  
    })
</script>