@component('mail::message')


@if(!empty($event->styles["banner_image_email"]))
![Logo]({{$event->styles["banner_image_email"]}})
@endif

<div>
    <span>

        @if($type == "comment" )
        
            <h1 style="text-align: center">Hola {{$user_receiver->properties["names"]}}, {{$user_sender->properties["names"]}} Ha comentado tu publicacion en el evento {{$event->name}}:</h1> 
            <div style="background-color:#E6E8EB;border-radius: 5px">
            
                <section style="text-align: left;padding:20px"><img src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/sonrisa.png?alt=media&token=396fdbce-d76d-4f7e-8df5-fdf4de30a912"> <strong> {{$user_receiver->properties["names"]}} </strong><br><br>{!! $post !!}<br>
                    @if($post_image != null)
                        <img src="{{$post_image}}">   
                    @endif
                    <div stlye="width:100%;text-align: right;">{{$datePost}}</div>
                    </section>
                    <hr><p style="text-align:center">Comentarios</p><hr>
                <section style="width:70%;margin-left:5%;padding:10px"><img src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/sonreir%20(3).png?alt=media&token=41351314-d748-4a1c-b8f1-ed11c183b97d">
                <strong> {{$user_sender->properties["names"]}} </strong>{!! $comment !!}</section>
            </div>
        @elseif( $type == "post" )

            <h1 style="text-align: center">Hola {{$user_receiver->properties["names"]}}, {{$user_sender->properties["names"]}} ha hecho una publicacion: </h1>
            <div style="background-color:#E6E8EB;border-radius: 5px">
            
                <section style="text-align: left;padding:20px"><img src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/sonrisa.png?alt=media&token=396fdbce-d76d-4f7e-8df5-fdf4de30a912"> <strong> {{$user_receiver->properties["names"]}} </strong><br><br>{!! $post !!}<br>
                @if($post_image != null)
                <img src="{{$post_image}}">   
                @endif
                <div stlye="width:100%;text-align: right;">{{$datePost}}</div>
            </div>
    
        @endif
        
    </span>
</div>

@component('mail::table')
| | |
| -------------------- |:--------------------------------------------------------------------------------------:|
| **Fecha:** | **Hora:** |
| {{ $date_time_from->formatLocalized('%A, %e de %B %Y') }}|{{ $date_time_from->formatLocalized('%l:%M %p') }} |
@endcomponent

<!--Boton de ingreso -->
@component('mail::button', ['url' => $link , 'color' => 'evius'])
Ingresar al Evento AQUÍ
@endcomponent


[Políticas de privacidad](https://evius.co/privacy) | 
[Términos y Condiciones](https://evius.co/terms)

<div style="text-align: center">
    <span>
        Recibiste este correo porque estás inscrito y/o invitado en un
        evento gestionado a través de <?= config('app.name')?> o te has
        registrado en el portal de <?= config('app.name')?>
    </span>
</div>
<div style="text-align: center">
    <span>

    </span>
    <span></span>
</div>
@slot('footer')
@component('mail::footer')
        © 2001-2020. All Rights Reserved - <?= config('app.name')?>
@endcomponent
@endslot
@endcomponent
