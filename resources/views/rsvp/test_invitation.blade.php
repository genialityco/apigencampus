<style>
    .text-qr {
        font-family: Avenir,Helvetica,sans-serif;
        box-sizing: border-box;
        font-size: 18px;
        text-align: left;
        padding: 10px;
        display: flex;
        justify-content: center !important;
    }
    .text-qr img {
        float: right; 
        width: 170px; 
        height: 170px;

    }
    @media(max-width: 600px) {
        .text-qr {
        display: block !important;
        }
        .text-qr img {
        float: none !important;
        width: 100% !important;
        height: auto !important;
        }
    }
    .text-footer {
        font-family: Avenir,Helvetica,sans-serif;
        box-sizing: border-box;
        font-size: 10px;
        text-align: center;
        padding: 10px;
        display: flex;
    }
    .text-footer p{
        margin: 0;
        font-size: 10px;
        font-style: italic;
        color: gray;
    }
</style>
@component('mail::message')
<table style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px" align="center">
    <thead>
        <tr>
          <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" alt="Evius" 
                        src= {{$image_header}} />  
                </div>
          </td>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:20px;text-align:center;padding:10px;display:block"> 
                {{ __ ('Mail.greeting')}} {{$eventUser_name}}, {{ __ ('Mail.successful_enrollment')}}
                <b>{{$event->name}}</b> ha sido exitosa.
            </td>
        </tr>
        <tr>
            <td class="text-qr">
                @if($event->type_event == "physicalEvent")
                    <div>
                        {{$date_time_from}}
                        @if($event->venue != null)
                            {{$event->venue}}
                        @endif
                        @if($event->address != null)
                            {{$event->address}}
                        @endif
                    </div>
                    <img src="{{$qr}}" />
                @elseif($event->type_event == "onlineEvent")
                    @component('mail::button', ['url' => $link , 'color' => 'green'])
                        {{ __('Mail.enter_event')}}
                    @endcomponent
                @elseif($event->type_event == "hybridEvent")
                    <div>
                        {{$date_time_from}}
                        @if($event->venue != null)
                            {{$event->venue}}
                        @endif
                        @if($event->address != null)
                            {{$event->address}}
                        @endif
                        @component('mail::button', ['url' => $link , 'color' => 'green'])
                            {{ __('Mail.enter_event')}}
                        @endcomponent
                    </div>
                    <img style="width: 170px; height: 170px; margin-left: 10px;"  src="{{$qr}}" />
                @endif
            </td>
        </tr>
        <tr>
            <td class="text-footer"> 
                <div style="text-align: center">
                    @if($event->type_event == "physicalEvent")
                        Nota: Recuerda que el acceso es de uso personal, no olvides presentarlo al ingreso del evento.
                    @elseif($event->type_event == "onlineEvent" || $event->type_event == "hybridEvent")
                        Nota: Recuerda que el acceso es de uso personal y no podrá ser abierto en dos o mas dispositivo al mismo tiempo.
                        <hr style="border-right : 0;border-left: 0;" />
                        <div style="text-align: center">
                            <p>
                                {{ __('Mail.recommend_browser') }}
                            </p>
                            <p>
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
            </td>
        </tr> 				 
        <tr>
            <td>
                <div class="centered">
                    <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="Evius" 
                        src= {{$image_footer}} />  
                </div>	
            </td>
        </tr>
    </tbody>
</table>
@endcomponent
