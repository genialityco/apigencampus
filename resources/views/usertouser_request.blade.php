@component('mail::message')
<div>
@if(isset($image_banner) && !empty($image_banner))
<img alt="{{$event->name}}" src={{$image_banner}} /> 
@endif
</div>
{{-- <div style="text-align: center">
	<span>
		{{ $title }} 
	</span>
</div> --}}

<div style="text-align: center">				
	{!!$desc !!}			
</div>

<div>
	@if ($request_type == 'friendship' && $response)
		<div style="text-align: center">
			@component('mail::button', ['url' => $link . "&response=accepted" , 'color' => 'evius'])
			Aceptar solicitud
			@endcomponent
		</div>
		<div style="text-align: center">
			@component('mail::button', ['url' => $link . "&response=rejected" , 'color' => 'evius'])
			Rechazar solicitud
			@endcomponent
		</div>
	@endif
</div>
<div>
	@if ($request_type == 'meeting' && $response && $status != "accepted" && $status != "rejected")
		<div style="text-align: center">
			@component('mail::button', ['url' => $link . "/accept" , 'color' => 'evius'])
				Aceptar solicitud
			@endcomponent
		</div>
		<div style="text-align: center">
			@component('mail::button', ['url' => $link . "/reject" , 'color' => 'evius'])
				Rechazar solicitud
			@endcomponent
		</div>
	@endif
</div>
@component('mail::button', ['url' => $link_authenticatedalevento, 'color' => 'evius'])
Ver Solicitudes en el Evento
@endcomponent
<div>	
	<p>
		<a href="{{$linkUnsubscribe}}">{{ __('Mail.unsubscribe')}}</a>
	</p>	
</div>



<!-- Click aqui
@component('mail::button', ['url' => url('/api/rsvp/confirmrsvp/5bb64a02c065863d470263a8'), 'color' => 'evius'])
Confirmar Cuenta
@endcomponent -->

[Políticas de privacidad](https://evius.co/privacy) |
[Términos y Condiciones](https://evius.co/terms)

<div style="text-align: center">
	<span>
		Recibiste este correo porque estás inscrito y/o invitado en un
		evento gestionado a través de <?= config('app.name')?> o te has
		registrado en el portal de <?= config('app.name')?>
	</span>
</div>
@if(isset($image_footer) && !empty($image_footer))
<img alt="{{$event->name}}" src={{$image_footer}} /> 
@endif
</div>
@endcomponent
