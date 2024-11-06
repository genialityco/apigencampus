@component('mail::message')
<div>
    <table style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:600px;color:#707173;border-radius:40px" align="center">
        <thead>
            <tr>
                 <td>
                    @if(!empty($event->styles["banner_image_email"]))
                        <div>
                            <img style="width:100%;max-width:600px;border-radius:20px 20px 0 0"  alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
                        </div>
                    @elseif(!empty($event->styles["banner_image"]))
                        <div class="centered">
                            <img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
                        </div>
                    @endif
                </td>
            </tr>
        </thead>    
        <tbody>
            <tr>
                <td style="font-size:20px;text-align:center;padding:10px 0 8px 0;display:block"> 
                   Usuario: {{$user->names}}
               </td>
            </tr>
            <tr>
                <td  style="padding:10px" >
                    <table style="background:#fdfdfd;border:solid 1px #cccccc;border-spacing:0;width:100%;padding:5px">
                        <tbody>
                            <tr>
                                <th style="font-weight:600;width:40%;line-height:14px;text-align:right;padding-right:10px">
                                    Email
                                </th>
                                <td style="padding:5px 0">
                                    {{$user->email}}
                                </td>   
                            </tr>                           
                            <tr>
                                <th style="font-weight:600;width:40%;line-height:14px;text-align:right;padding-right:10px">
                                    Valor ofertado
                                </th>
                                <td style="padding:5px 0">
                                    {{$product->price}}
                                </td>
                            </tr>
                            <tr>
                                <th style="font-weight:600;width:40%;line-height:14px;text-align:right;padding-right:10px">
                                    Nombre del árticulo
                                </th>
                                <td style="padding:5px 0">
                                    {{$product->name}}
                                </td>
                            </tr>    
                            <tr>
                                <th style="font-weight:600;width:40%;line-height:14px;text-align:right;padding-right:10px">
                                    Imagen del árticulo
                                </th>
                                <td style="font-weight:600;width:30%;line-height:14px;text-align:right;padding-right:10px">
                                    <img style="width:100%;max-width:600px;"  alt="{{$event->name}}" src={{$prodcutImages}} />                                        
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="font-size:13px;text-align:center;padding:10px 0 8px 0;display:block"> 
                    Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar, algunas características pueden no estar disponibles en navegadores no soportados
               </td>
            </tr>
            <tr>
                <td>
                    <hr style="width:90%;">
                </td>
            </tr>
            <tr>            
                <td style="font-size:13px;text-align:center;padding:10px 0 8px 0;display:block"> 
                    Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>
               </td>
            </tr>                       
            <tr>
                <td>
                    @if(!empty($event->styles["banner_footer_email"]))
                        <div class="centered">
                            <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="{{$event->name}}" src={{$event->styles["banner_footer_email"]}} /> 
                        </div>
                    @elseif(!empty($event->styles["banner_footer"]))
                        <div class="centered">
                            <img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="{{$event->name}}" src={{$event->styles["banner_footer"]}} />  
                        </div>
                    @endif
                </td>
            </tr>
        </tbody>    
    </table>
   
    
</div>
@endcomponent
