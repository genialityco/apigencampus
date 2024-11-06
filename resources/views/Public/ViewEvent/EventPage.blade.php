@extends('Public.ViewEvent.Layouts.EventPage')

        @if($event['seats_configuration']['status'] && !isset($temporal_id))
        <div id="ticket-section"> 

            <ticket-selection 
            :event="{{$event}}" 
            :tickets="{{$tickets}}" 
            :stage_act="{{$stage_act}}" 
            :auth="{{$auth}}" 
            >
            <ticket-selection>
        </div>
        @else
            @include('Public.ViewEvent.Partials.EventTicketsSection')
        @endif


