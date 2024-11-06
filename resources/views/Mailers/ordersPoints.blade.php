@component('mail::message')  
<div style="border: 1px solid rgb(187, 187, 187);">
@if(!empty($organizer->banner_image_email))
    <div class="centered">
        <img alt="{{$organizer->name}}" src={{$organizer->banner_image_email}} /> 
    </div>
@endif
@if($status == 'VALID')
<div class="centered">
    <p style="font-size: 20px;color: gray;font-style: italic">
        ¡Felicitaciones! tu redención de puntos ha sido exitosa                       
    </p>
</div>
@else
<div class="centered">
    <p style="font-size: 20px;color: gray;font-style: italic">
       Lo sentimos tu redención del producto ha sido <strong>rechazada</strong>
    </p>
</div>
@endif
<div>
    <p style="font-size: 17px;color: gray;">
        Datos  del usuario
    </p>
    <p style="font-size: 15px;color: gray;; ">
        <strong>Nombres:</strong>{!!$order->first_name!!}{!!$order->last_name!!}<br/>
        <strong>Email:</strong>{!!$order->email!!}<br/>
    </p>
</div>      
<div  style="maegin: 20px;border: 1px solid rgb(187, 187, 187); width : 70%; margin : auto; margin-bottom : 10px;">    
    <p style="font-size: 17px;color: gray;">
        Detalle
    </p>
    <p style="font-size: 15px;color: gray; text-align:left; margin-left:15px">
        -<strong>ID:</strong>{!!$order->_id!!}<br/>
        -{!!$orderSpecification !!}    
        -<strong>Total de puntos:</strong>{!!$order->amount!!}<br/>
        -<strong>Fecha y hora:</strong>{!!$order->created_at!!}
    </p>
</div>  
@if(!empty($organizer->footer_image_email) && $status == 'VALID')
    <div class="centered">
        <img alt="{{$organizer->name}}" src={{$organizer->footer_image_email}} /> 
    </div>
@endif
</div>
@endcomponent

