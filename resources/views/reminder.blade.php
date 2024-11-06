@component('mail::message')

<div style="text-align: center">
    {{ $title }} 
</div>
<div style="text-align: center">
    {!!$desc  !!}   
</div>



<!-- Click aqui
@component('mail::button', ['url' => url('/api/rsvp/confirmrsvp/5bb64a02c065863d470263a8'), 'color' => 'evius'])
Confirmar Cuenta
@endcomponent -->

 <img src="https://storage.googleapis.com/herba-images/evius/events/r3iw80h3baGMMjGiQaq1Zlnon7pcjbYQT0tjtzQd.png"> 

[Políticas de privacidad](https://evius.co/privacy) | 
[Términos y Condiciones](https://evius.co/terms)

<div style="text-align: center">
    <span>
        Recibiste este correo porque estás inscrito y/o invitado en un
        evento gestionado a través de <?= config('app.name')?> o te has
        registrado en el portal de <?= config('app.name')?>
    </span>
</div>

@slot('footer')
@component('mail::footer')
        © 2001-2018. All Rights Reserved - <?= config('app.name')?>
        is a registered trademark of MOCION
@endcomponent
@endslot
@endcomponent
