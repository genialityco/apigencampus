@component('mail::message')

@if(!empty($event->styles["banner_image_email"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
</div>
{{-- @elseif(!empty($event->styles["banner_image"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
</div> --}}
@endif
<br />
<br />
<div class="centered"  style="font-size: 18px;color">
{{ __ ('Mail.greeting')}} {{$eventUser->properties['names']}}, la compra ha sido satisfactoria en:
<b>{{$event->name}}</b>
</div>

{{-- @if(!empty($event->styles["event_image"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["event_image"]}} /> 
</div>
@endif --}}

<br />
<br />
<div class="centered">
	<p><b>Tu orden es</b><br/># Orden: {{$order->_id}}</p>
	<br />
	<p>Tickets disponibles {{count($qrs)}}</p>
</div>


<p style="font-size: 15px;color: gray;font-style: italic">
	{{ __('Mail.support_mail') }} <?= config('app.support_email') ?>
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

@endcomponent