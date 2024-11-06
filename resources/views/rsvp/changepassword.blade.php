@component('mail::message')  
** {{ __('Mail.greeting') }} {{$eventUser_name}} **, {{ __('Mail.password_change_successful')}}

{{ __('Mail.new_password')}}: {{$password}}

{{ __('Mail.login') }}
	<a href="{{$link}}">{{ __('Mail.enter_button') }}</a>
</p>

<p style="font-size: 15px;color: gray;font-style: italic">
	{{ __ ('Mail.support_mail')}} <?= config('app.support_email') ?>
</p>
  
</div>
@endcomponent