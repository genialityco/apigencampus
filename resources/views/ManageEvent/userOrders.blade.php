@extends('Shared.Layouts.Master')


@section('content')
<!--Start Attendees table-->
<div class="row">

    @if($orders->count())

    <div class="col-md-12">

        <!-- START panel -->
        <div class="panel">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                               {!! (trans("Order.order_ref")) !!}
                            </th>
                            <th>
                               {!! (trans("Order.order_date")) !!}
                            </th>
                            <th>
                               {!! (trans("Attendee.name")) !!}
                            </th>
                            <th>
                               {!! (trans("Attendee.email")) !!}
                            </th>
                            <th>
                               {!! (trans("Order.amount")) !!}
                            </th>
                            <th>
                               {!! (trans("Order.status")) !!}
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                        <tr>
                            <td>
                                @if($order->url)
                                    <a href='{{$order->url}}' target="_blank">{{$order->order_reference}}</a>
                                @else
                                <a href='javascript:void(0);' data-modal-id='view-order-{{ $order->id }}' data-href="{{route('showManageOrder', ['order_id'=>$order->id])}}" title="@lang("Order.view_order_num", ["num"=>$order->order_reference])" class="loadModal">
                                    {{$order->order_reference}}
                                </a>
                                @endif
                                
                            </td>
                            <td>
                                {{ $order->created_at->toDayDateTimeString() }}
                            </td>
                            <td>
                                {{$order->first_name.' '.$order->last_name}}
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="loadModal"
                                    data-modal-id="MessageOrder"
                                    data-href="{{route('showMessageOrder', ['order_id'=>$order->id])}}"
                                > {{$order->email}}</a>
                            </td>
                            <td>
                                {{$order->amount}}
                            </td>
                            <td>
                                @if(isset($order->orderStatus->name))
                                    <span class="label label-{{(!$order->is_payment_received || $order->is_refunded || $order->is_partially_refunded) ? 'warning' : 'success'}}">
                                        {{ $order->orderStatus->name }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- <a data-modal-id="view-order-{{ $order->id }}" data-href="{{route('showManageOrder', ['order_id'=>$order->id])}}" title="@lang("Order.view_order")" class="btn btn-xs btn-primary loadModal">@lang("Order.details")</a> -->
                                <a href='{{$order->url}}' target="_blank" class="btn btn-xs btn-primary">
                                    @lang("Order.details")
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @else

    @if($q)
    @include('Shared.Partials.NoSearchResults')
    @else
    @include('ManageEvent.Partials.OrdersBlankSlate')
    @endif

    @endif
</div>    <!--/End attendees table-->
@stop

<style>
#header{
    display: none;
}
</style>