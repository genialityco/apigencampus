@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
        @if(!$event->is_live)

        {{ @trans("ManageEvent.event_not_live") }}
        <a href="{{ route('MakeEventLive' , ['event_id' => $event->id]) }}"
           style="background-color: green; border-color: green;"
        class="btn btn-success btn-xs">{{ @trans("ManageEvent.publish_it") }}</a>
        @endif
    </div>
</section>
@endif
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='{{$event->event_url}}#organiser'" class="event_organizer">
                    <b>{{$event->name}}</b> @lang("Public_ViewEvent.presents")
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 property="name">{{$event->name}}</h1>
            <div class="event_venue">
                <span property="startDate" content="{{ $event->datetime_from }}">
                    {{ $event->startDateFormatted() }}
                </span>f
                -
             <span property="endDate" content="{{ $event->datetime_to }}">
                        {{ $event->endDateFormatted() }}
                </span>
                @lang("Public_ViewEvent.at")
                <span property="location" typeof="Place">
                    <b property="name">{{$event->venue_name}}</b>
                    <meta property="address" content="{{ urldecode($event->venue_name) }}">
                </span> 
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{{$event->event_url}}}#tickets">@lang("Public_ViewEvent.TICKETS")</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{{$event->event_url}}}#details">@lang("Public_ViewEvent.DETAILS")</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{{$event->event_url}}}#location">@lang("Public_ViewEvent.LOCATION")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
