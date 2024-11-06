<style>
.button {
  border-radius: 15px;
  background-color: #00f0be;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
  -ms-flex-pack: center;
  justify-content: center;
  padding: calc(.375em - 1px) .75em;
  text-align: center;
  white-space: nowrap;
  font-family: Montserrat,sans-serif;
  transition: all .33s ease;
}
.button.is-primary {
    background-color: #00f0be;
    border-color: transparent;
    color: #fff;
}
.has-text-weight-bold {
    font-weight: 700!important;
}
</style>
<html>
    <body>

        <div style="width:75%; margin:1em auto; height: auto; border: 1px solid lightgrey;">
            <div style="width:70%; margin:0 auto; padding: 3em 0">
            
            <a href=config('app.front_url')."" class="button">volver</a>

                <div style="width:100%">
                    <div style=" width:40%; margin: 0 auto">
                        <img src="{{ asset('images/logo.png') }}" width="100%"/>
                    </div>
                </div>
                    <div style="display:block;">
                        <H2 style="text-align:center">Bienvenido a continuación puede descargar el reporte de ventas de los Eventos</H2>
                    </div>
                <br>
                    <div class="panel">
                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                        Eventos
                                        </th>
                                        <th>
                                        Descargar
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        @if(!$event->is_test && $event->sales_volume > 0)
                                                <td>
                                                    {{$event->name}}
                                                </td>
                                                <td>
                                                <a class="button" href="{{route('showEventsReportsExport', ['event_id'=>$event->id,'export_as'=>'xlsx'])}}">@lang("File_format.Excel_xlsx")</a>
                                                </td>
                                        @endif
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

