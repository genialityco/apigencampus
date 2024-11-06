@component('mail::message')  
    {!! $message !!}
    <div style="text-align: center">
    @if(isset($link))
    <br>
    <br>
    {!! $action_link !!}
    @endif
    <br>
    </div>
@endcomponent