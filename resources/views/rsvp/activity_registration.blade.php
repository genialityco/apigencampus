@component('mail::message') 
<div class="centered"> 

<h2>Confirmación de registro a {{$activity->name}}</h2>

<!-- Mensaje personalizado del CMS -->
@if ($activity->registration_message)
{!!$activity->registration_message!!}
@endif
</div>

<div class="centered">
<img src="{{$activity->image}}"></img>
</div>

<div style="font-size: 8px;color: gray;font-style: italic">
<p >Si tiene alguna inquietud puede contactarnos por cualquiera de estos medios de soporte:</p>
<p><a href="mail://<?= config('app.support_email')?>  ">Correo electónico: <?= config('app.support_email')?> </a></p>
<p ><a href="tel:+5715451988">Linea teléfonica Bogotá (571)575451988</a></p>
<p ><a href="https://api.whatsapp.com/send?phone=573002162757&text=Pregunta%20de%20EVIUS%20{{$activity->name}}&source=&data=&app_absent=">
Vía whatsapp 
</a></p>
<p>Sede principal: Bogotá–Colombia </p>
</div>
@endcomponent

