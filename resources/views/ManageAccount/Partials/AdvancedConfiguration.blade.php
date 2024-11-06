
{!! Form::model($account, array('url' => route('postEditAdvancedConfiguration'), 'class' => 'ajax')) !!}
{{ Form::hidden('event_id', $event_id) }}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        {!! Form::checkbox('allow_company', true, ['class' => 'form-control gateway_selector']); !!}
        {!! Form::label('allow_company', 'Habilitar acompañante por tiquete', array('class'=>'control-label ')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            {!! Form::submit("Guardar la configuración avanzada", ['class' => 'btn btn-success pull-right']) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}

