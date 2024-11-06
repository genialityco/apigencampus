
{!! Form::model($account, array('url' => route('postEditSeats'), 'class' => 'ajax')) !!}
{{ Form::hidden('event_id', $event_id) }}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('key_secret', "Llave secreta", array('class'=>'control-label required')) !!}
            @if($seats_configuration)
                {!! Form::text('key_secret', $seats_configuration['keys']['secret'], array('class'=>'form-control control-label required')) !!}
            @else
                {!! Form::text('key_secret', '', array('class'=>'form-control control-label required')) !!}
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('key_public', "Llave publica", array('class'=>'control-label required')) !!}
            @if($seats_configuration)
                {!! Form::text('key_public', $seats_configuration['keys']['public'], array('class'=>'form-control control-label required')) !!}
            @else
                {!! Form::text('key_public', '', array('class'=>'form-control control-label required')) !!}
            @endif    
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('key_designer', "Llave de diseño", array('class'=>'control-label required')) !!}
            @if($seats_configuration)
                {!! Form::text('key_designer', $seats_configuration['keys']['designer'], array('class'=>'form-control control-label required')) !!}
            @else
                {!! Form::text('key_designer', '', array('class'=>'form-control control-label required')) !!}
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('key_event', "Id del evento", array('class'=>'control-label required')) !!}
            @if($seats_configuration)
                {!! Form::text('key_event', $seats_configuration['keys']['event'], array('class'=>'form-control control-label required')) !!}
            @else
                {!! Form::text('key_event', '', array('class'=>'form-control control-label required')) !!}
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        {!! Form::label('language', 'es', array('class'=>'control-label ')) !!}
        {!! Form::radio('language',  true, ['class' => 'form-control gateway_selector']); !!}
        {!! Form::label('language', 'en', array('class'=>'control-label ')) !!}
        {!! Form::radio('language',  false, ['class' => 'form-control gateway_selector']); !!}
        
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        {!! Form::label('status', 'activar', array('class'=>'control-label ')) !!}
        {!! Form::checkbox('status', true, ['class' => 'form-control gateway_selector']); !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        {!! Form::label('minimap', 'mini mapa', array('class'=>'control-label ')) !!}
        {!! Form::checkbox('minimap', true, ['class' => 'form-control gateway_selector']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            {!! Form::submit("Guardar los datos del mapa", ['class' => 'btn btn-success pull-right']) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}

