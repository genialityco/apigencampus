@component('mail::message')

@if(isset($image_header) && !empty($image_header))
<div class="centered">
  <img alt="{{$event->name}}" src={{$image_header}} /> 
</div>
@elseif(!empty($event->styles["banner_image_email"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
</div>
@elseif(!empty($image_header)){{-- Se cambio la condicion--}}
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
</div>
@endif
<div class="centered">
{{ __('Mail.greeting') }} {{$eventUser_name}},
</div>
@if(!empty($content_header) && $content_header != '<p><br></p>')
{!!$content_header !!}
@endif
<div>
<p>USUARIO: {{$eventUser->properties['email']}} </p>
@if(isset($eventUser->properties['identificacion']))
<p>CLAVE: {{$eventUser->properties['identificacion']}}</p>
@else <div style="text-align: center">
	@if($event->type_event == "physicalEvent")
		<img  src="{{$qr}}" />
		@elseif($event->type_event == "onlineEvent")
			@component('mail::button', ['url' => $link , 'color' => 'evius'])
				{{ __ ('Mail.enter_event')}}
			@endcomponent
		@elseif($event->type_event == "hybridEvent")
			<img  src="{{$qr}}" />
			@component('mail::button', ['url' => $link , 'color' => 'evius'])
				{{ __ ('Mail.enter_event')}}
			@endcomponent
	@endif

</div>
@endif
</div>
@if(is_null($include_date) || $include_date == true || $include_date != false )
@if($ticket_title)
{{-- ha sido invitado a: --}}
<strong>{!! $ticket_title !!}</strong>
@endif
{{-- //Formato para la fecha se encuentra en: https://www.php.net/manual/es/function.strftime.php --}}
@component('mail::table')
| | |
| -------------------- |:--------------------------------------------------------------------------------------:|
| **{{ __('Mail.date') }}:** | **{{ __('Mail.hora') }}:** |
|	Inicia: {{$date_time_from->format('m-d-Y')}}|{{$date_time_from->format('H:i:s')}} |
|	Termina: {{$date_time_to->format('m-d-Y')}}|{{$date_time_to->format('H:i:s')}} |
{{-- | {{ $date_time_from->formatLocalized('%A, %e de %B %Y') }}|{{ $date_time_from->formatLocalized('%l:%M %p') }} |
| {{ $date_time_to->formatLocalized('%A, %e de %B %Y') }}|{{ $date_time_to->formatLocalized('%l:%M %p') }} | --}}
@endcomponent
@endif
@if(!empty($image))
	<div class="centered">
		<img alt="{{$event->name}}" src="{{ $image }}">
	</div>
@endif
@if(!empty($message) && $message != '<p><br></p>')
{!!$message!!}
@endif
@if ($event->registration_message && $type == "newuser" )
{!!$event->registration_message!!}
@endif
<p>Ingresar con enlace de ingreso único </p>
<div style="text-align: center">
	@if($event->type_event == "physicalEvent")
		<img  src="{{$qr}}" />
		@elseif($event->type_event == "onlineEvent")
			@component('mail::button', ['url' => $link , 'color' => 'evius'])
				{{ __ ('Mail.enter_event')}}
			@endcomponent
		@elseif($event->type_event == "hybridEvent")
			<img  src="{{$qr}}" />
			@component('mail::button', ['url' => $link , 'color' => 'evius'])
				{{ __ ('Mail.enter_event')}}
			@endcomponent
	@endif
</div>

{{-- <div>
	@if(is_null($include_login_button) || $include_login_button == true || $include_login_button != false )
		@component('mail::button', ['url' => $link , 'color' => 'evius'])
			{{ __ ('Mail.enter_event')}}
		@endcomponent
	@endif
</div> --}}

<div style="text-align: center">
	@if($event->type_event == "physicalEvent")
	Nota: Recuerda que el acceso es de uso personal, no olvides presentarlo al ingreso del evento.
		@elseif($event->type_event == "onlineEvent" || $event->type_event == "hybridEvent")
		Nota: Recuerda que el acceso es de uso personal y no podrá ser abierto en dos o mas dispositivo al mismo tiempo.
		<hr style="border-right : 0;border-left: 0;" />
		<div style="text-align: center">
			<p style="font-size: 15px;color: gray;font-style: italic">
				{{ __('Mail.recommend_browser') }}
			</p>
			<p style="font-size: 15px;color: gray;font-style: italic">
				{{ __('Mail.support_mail') }}
			</p>
		</div>
		<p>
			{{ __('Mail.alternative_entry')}}
			<a href="{{$link}}">{{ __('Mail.enter_button')}}</a>
		</p>
		@elseif($event->type_event == "hybridEvent")
	@endif
</div>

<div>	
	<p>
		<a href="{{$linkUnsubscribe}}">{{ __('Mail.unsubscribe')}}</a>
	</p>	
</div>

<div class="centered">
	@if(isset($image_footer) && !empty($image_footer))
		<img alt="{{$event->name}}" src={{$image_footer}} />
		@elseif(isset($event->styles["banner_footer_email"]) && !empty($event->styles["banner_footer_email"]))
		<img alt="{{$event->name}}" src={{$event->styles["banner_footer_email"]}} />  
		@elseif(isset($event->styles["banner_footer"]) && !empty($image_footer))
		<img alt="{{$event->name}}" src={{$event->styles["banner_footer"]}} />           
		@elseif(isset($organization_picture) && !empty($organization_picture))
		<img alt="{{$event->name}}" src={{$organization_picture}} /> 
	@endif	
</div>


@endcomponent