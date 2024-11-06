@component('mail::message')  

<br />
<br />
¡FELICITACIONES! tu compra de <b>{{$event->name}}</b> ha sido exitosa.
<br />



<hr style="border-right : 0;border-left: 0;" />

<p style="font-size: 15px;color: gray;font-style: italic">
    Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar,
    algunas caracteristicas pueden no estar disponibles en navegadores no soportados.
</p>
<p style="font-size: 15px;color: gray;font-style: italic">
    Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>  
</p>



@endcomponent