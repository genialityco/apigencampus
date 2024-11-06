{!! Form::model($account, array('url' => route('postEditTicketsPromocional'), 'class' => 'ajax ')) !!}
{{ Form::hidden('event_id', $event_id) }}

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('percentage_discount', trans("ManageAccount.percentage_discount"), array('class'=>'control-label required')) !!}
            {!! Form::selectRange('percentage_discount', 0, 100, $percentage_discount , array('class'=>'form-control control-label required')) !!}
        </div>
    </div>
    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('tickets_discount', trans("ManageAccount.tickets_discount"), array('class'=>'control-label required')) !!}
            {!! Form::selectRange('tickets_discount', 0, 20, $ticket_discount , array('class'=>'form-control control-label required')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            {!! Form::submit(trans("ManageAccount.save_payment_details_submit"), ['class' => 'btn btn-success pull-right']) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}
