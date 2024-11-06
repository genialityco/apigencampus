{{-- @component('mail::message')  

    
    

    

    
@endcomponent --}}

@component('mail::message')  
{{-- @if(!empty($event->styles["banner_image_email"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
</div>
@elseif(!empty($event->styles["banner_image"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
</div>
@endif --}}
<br />
<br />
<div>
    <p style="text-align:left; width: 100%;">
        @if(isset($event->name))
            ¡FELICITACIONES! tu compra del código  para el curso  <b>{{$event->name}}</b> ha sido exitosa.
        @else
            ¡FELICITACIONES! tu compra del código para redimidir en cualquier curso de nuestra plataforma ha sido exitosa.    
        @endif
        <br />
        Tu código de regalo es: <b>{{$code->code}}</b><br>
        Límite de usos : <b>{{$codeTemplate->use_limit}}</b>
        <br />
        Descuento:
        @if($codeTemplate->discount_type == "percentage")
            <b>{{$codeTemplate->discount}}%</b>
        @else
            <b>${{$codeTemplate->discount}}</b>    
        @endif
        <br />
    </p>
</div>

<hr style="border-right : 0;border-left: 0;" />

<p style="font-size: 15px;color: gray;font-style: italic">
    Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar,
    algunas caracteristicas pueden no estar disponibles en navegadores no soportados.
</p>
<p style="font-size: 15px;color: gray;font-style: italic">
    Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>  
</p>

{{-- <div class="centered">
    @if(isset($image_footer) && !empty($image_footer))
        ![Logo]({{!empty($image_footer)}})
        <img alt="{{$event->name}}" src={{$image_footer}} /> 
    @elseif(isset($event->styles["banner_footer_email"]) && !empty($event->styles["banner_footer_email"]))
        <img alt="{{$event->name}}" src={{$event->styles["banner_footer_email"]}} />  
    @elseif(isset($event->styles["banner_footer"]) && !empty($event->styles["banner_footer"]))
        <img alt="{{$event->name}}" src={{$event->styles["banner_footer"]}} />           
    @elseif(isset($organization_picture) && !empty($organization_picture))
        <img alt="{{$event->name}}" src={{$organization_picture}} />           
    @endif
</div> --}}

@endcomponent