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
{{ __ ('Mail.greeting')}} {{$eventUser_name}}, {{ __ ('Mail.successful_enrollment')}}:
<b>{{$event->name}}</b>
</div>
{{-- Mensaje configurable desde el CMS en la sección configuración asistentes --}}
@if($event->registration_message )

{!!$event->registration_message!!}

@endif

 {{-- Por si tiene asociado un tickete con sala  --}}
@if(!empty($eventUser->ticket_title))
<strong>{!! $eventUser->ticket_title!!} </strong>
@endif

@if(!empty($event->styles["event_image"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["event_image"]}} /> 
</div>
@endif

<div style="text-align: center">
	@if($event->type_event == "physicalEvent")
		<img  src="{{$qr}}" />
	 @else
		@component('mail::button', ['url' => $link , 'color' => 'evius'])
			{{ __ ('Mail.enter_event')}}
		@endcomponent
	@endif
</div>

<hr style="border-right : 0;border-left: 0;" />
<div style="text-align: center">
<p style="font-size: 15px;color: gray;font-style: italic">
	{{ __('Mail.recommend_browser') }}
</p>
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
