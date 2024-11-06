@component('mail::message')  
<div class="centered">  
<div class="centered">  
@if(!empty($event->styles["banner_image_email"]))
<img alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
@elseif(!empty($event->styles["banner_image"]))
<img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
@endif
</div>
<br />
<br />


{{ __ ('Mail.greeting')}} {{$eventUser['properties']['names']}}
<br/>
Tu estado de usuario ha sido cambiado a <strong>{{$rol->name}}</strong>
<br/>
@if(isset($message))
	{{$message}}
@endif
<hr style="border-right : 0;border-left: 0;" />
<div style="text-align: center">
<p style="font-size: 15px;color: gray;font-style: italic">
Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar, algunas características pueden no estar disponibles en navegadores no soportados
</p>
<p style="font-size: 15px;color: gray;font-style: italic">
Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>
</p>
</div>


<div class="centered">
@if(isset($image_footer) && !empty($image_footer))
	<img alt="{{$event->name}}" src={{$image_footer}} /> 	
	@elseif(isset($event->styles["banner_footer_email"]) && !empty($event->styles["banner_footer_email"]))
	<img alt="{{$event->name}}" src={{$event->styles["banner_footer_email"]}} />  
	@elseif(isset($event->styles["banner_footer"]) && !empty($event->styles["banner_footer"]))
	<img alt="{{$event->name}}" src={{$event->styles["banner_footer"]}} />           
	@elseif(isset($organization_picture) && !empty($organization_picture))
	<img alt="{{$event->name}}" src={{$organization_picture}} /> 
@endif

</div>
</div>
@endcomponent
