@component('mail::message')    
@if(!empty($organization->styles["banner_image"]))
<div class="centered">
	<img alt="{{$organization->name}}" src={{$organization->styles["banner_image"]}} />  
</div>
@endif

<br />
<br />

<div class="centered"  style="font-size: 18px; color: black">
	{{ __ ('Mail.greeting')}} {{isset($client_name) ? $client_name : 'usuario'}} 
	
	{!! ($organization->registration_message)? $organization->registration_message: __ ('Mail.successful_organization_registered') !!}:
	<b>{{$organization->name}}</b>
</div>

@if(!empty($organization->styles["event_image"]))
<div class="centered">
<img alt="{{$organization->name}}" src={{$organization->styles["event_image"]}} /> 
</div>
@endif

<div style="text-align: center;">
	<hr style="border-right : 0;border-left: 0;" />
	<div style="text-align: center">
		<p style="font-size: 15px;color: gray;font-style: italic">
			{{ __('Mail.recommend_browser') }}
		</p>
		<p style="font-size: 15px;color: gray;font-style: italic">
			{{ __('Mail.support_mail') }}
		</p>
	</div>
	<p>
		{{ __('Mail.alternative_entry')}}
		<a href="{{$link}}">{{ __('Mail.enter_button')}}</a>
	</p>
</div>

<div class="centered">
	@if(isset($organization->styles["banner_footer_email"]) && !empty($organization->styles["banner_footer_email"]))
	<img alt="{{$organization->name}}" src={{$organization->styles["banner_footer_email"]}} />  
	@elseif(isset($organization->styles["banner_footer"]) && !empty($organization->styles["banner_footer"]))
	<img alt="{{$organization->name}}" src={{$organization->styles["banner_footer"]}} />           
	@elseif(isset($organization->styles["event_image"]) && !empty($organization->styles["event_image"]))
	<img alt="{{$organization->name}}" src={{$organization->styles["event_image"]}} /> 
	@endif
</div>
@endcomponent