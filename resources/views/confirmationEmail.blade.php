@component('mail::message')


Hola {{$user_name}}!

<div style="text-align: center">
	<span>
		¡Te damos la bienvenida a <?= config('app.name')?>! Antes de empezar,
		debes confirmar tu dirección de correo electrónico.
	</span>
</div>

@component('mail::button', ['url' => url('/api/confirmEmail/'.$user_id), 'color' => 'evius'])
Confirmar Cuenta
@endcomponent

@component('mail::subcopy')
@endcomponent
<div style="text-align: center">
	<span>
		Gracias,
		El equipo de <?= config('app.name')?>.
	</span>
</div>
![<?= config('app.name') ?>]({{$logo}})
@slot('footer')
@component('mail::footer')
© All Rights Reserved - <?= config('app.name')?>
@endcomponent
@endslot
@endcomponent