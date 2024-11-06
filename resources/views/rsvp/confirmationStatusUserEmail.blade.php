@component('mail::message')


Hola {{$user->displayName}}!

<div style="text-align: center">
	<span>
        @if($user->status == 'approved')
            <p>
                Bienvenido al equipo de {{$organization->displayName}}. Tu perfil ha sido aceptado como docente. 
                A partir de ahora podrás empezar a crear clases.
                Es importante que el contenido que crees venga desde tu experiencia, 
                ya que esto es lo que buscan las personas de la comunidad {{$organization->displayName}}.
                <br>
                Bienvenido a {{$organization->displayName}}!
            </p>
        @else
        <p>
            Tu perfil ha sido rechazado por el equipo académico de {{$organization->displayName}}. 
            Sigue trabajando en tu perfil y vuelve a presentarte con ideas nuevas para ser parte del equipo de {{$organization->displayName}}. 
        </p>
        @endif
    </span>
    <hr style="border-right : 0;border-left: 0;" />
    <p style="font-size: 15px;color: gray;font-style: italic">
        Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar,
        algunas caracteristicas pueden no estar disponibles en navegadores no soportados.
    </p>
    <p style="font-size: 15px;color: gray;font-style: italic">
    Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>  
    </p>
</div>



@slot('footer')
@component('mail::footer')
© All Rights Reserved - <?= config('app.name')?>
@endcomponent
@endslot
@endcomponent