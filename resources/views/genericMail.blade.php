@component('mail::message')  
    <div style="text-align: center">
    <p><strong>Nombre del usuario: </strong>{{$userName}}</p>
    <p><strong>Correo del usuario: </strong>{{$emailUser}}</p>
    <p>
        {!! $message !!}
    </p>
    </div>

@endcomponent