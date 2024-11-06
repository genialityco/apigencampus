@component('mail::message')
@if(!empty($event->styles["banner_image_email"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image_email"]}} /> 
</div>
{{-- @elseif(!empty($event->styles["banner_image"]))
<div class="centered">
<img alt="{{$event->name}}" src={{$event->styles["banner_image"]}} />  
</div> --}}
@endif
<br />
<br />

<table style="font-family:arial;border:1px solid #e8e6e6;border-top:none;border-bottom:none;border-spacing:0;max-width:1000px;color:#000000;border-radius:40px" align="center">
		<thead>
			<tr>
			  <td>
					<div class="centered">
						<img style="width:100%;max-width:600px;border-radius:20px 20px 0 0" alt="<?= config('app.name') ?>" src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FHeader_<?= config('app.name') ?>_1920x540px%20(1).png?alt=media&token=521a9303-f274-437e-90d6-bb887761e13f" />  
					</div>
			  </td>
		  </tr>
		</thead>
		<tbody>
			<tr>
				<td style="font-size:20px;text-align:center;padding:10px;display:block"> 
					¡{{$user->names}} te damos la bienvenida!
				</td>
			 </tr>
             <tr>
				<td style="font-size:14px;text-align:left;padding:10px;display:block"> 
					Gracias por registrarte en <?= config('app.name') ?>, estamos encantados de que te hayas unido a nosotros.<br/>
                    Ingresa <a href="https://app.geniality.com.co">aquí</a> para disfrutar de tus cursos.
				</td>
			 </tr>		
             <tr>
				<hr style="border-right : 0;border-left: 0;" />
			</tr>
			 <tr>
				<td style="font-size:13px;text-align:left;padding:10px;display:block"> 
					Se recomienda usar los navegadores Google Chrome, Mozilla Firefox para ingresar, algunas características pueden no estar disponibles en navegadores no soportados
			   </td>
			</tr>        
			<tr>            
				<td style="font-size:13px;text-align:center;padding:10px;display:block"> 
					Si tiene inconvenientes para ingresar a la plataforma o durante las sesiones, no dude en escribirnos al siguiente correo <?= config('app.support_email')?>
			   </td>
			</tr>	 				 
			 <tr>
				<td>
					<div class="centered">
						<img style="width:100%;max-width:600px;border-radius:0 0 20px 20px" alt="<?= config('app.name') ?>" src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FFooter_<?= config('app.name') ?>_1920x200px%20(1).png?alt=media&token=5216761a-b9b2-41e5-8552-5dcbc2a61c7a"/>  
					</div>	
				</td>
			</tr>
		</tbody>
	</table>
@endcomponent		