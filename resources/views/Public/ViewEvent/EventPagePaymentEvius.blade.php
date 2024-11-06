<?php
    // var_dump($ticket_order);die;
?>
@extends('Public.ViewEvent.Layouts.EventPage')

<style>
    /*@todo This is temp - move to styles*/
    h3 {
        border: none !important;
        font-size: 30px;
        text-align: center;
        margin: 0;
        margin-bottom: 30px;
        letter-spacing: .2em;
        font-weight: 200;
    }

    .order_header {
        text-align: center
    }

    .massive-icon {
        display: block;
        width: 120px;
        height: 120px;
        font-size: 100px;
        margin: 0 auto;
        color: #63C05E;
    }

    h1 {
        margin-top: 20px;
        text-transform: uppercase;
    }

    h2 {
        margin-top: 5px;
        font-size: 20px;
    }

    .order_details.well, .offline_payment_instructions {
        margin-top: 25px;
        background-color: #FCFCFC;
        line-height: 30px;
        text-shadow: 0 1px 0 rgba(255,255,255,.9);
        color: #656565;
        overflow: hidden;
    }

    .ticket_download_link {
        border-bottom: 3px solid;
    }
</style>

<section id="order_form" class="container">
    <div class="row">
        <div class="col-md-8">
            <span class="massive-icon">
                <i class="ico ico-checkmark-circle"></i>
            </span>
            <h1>{{   @trans("Public_ViewEvent.thank_you_for_your_order")  }}</h1>
            <h2>
                    {{  @trans("Public_ViewEvent.tickets_payment<?= config('app.name') ?>")  }}
            </h2>

            <div id="buttons-payment-evius">
                <a href="#" ref="{{ $ticket_order['orderid'] }}" id="APPROVED" class="button-submit-payment btn btn-outline-danger" style="background-color: #17a2b8;">Confirmar Compra</a>
                <a href="{{ $ticket_order['url_redirect'] }}"   class="btn btn-outline-success" style="background-color: gray;">Pasarela de Pago</a>
                <a href="#"  ref="{{ $ticket_order['orderid'] }}"  id="CANCELLED" class="button-submit-payment btn btn-outline-danger" style="background-color: gray;">Cancelar Orden</a>
                <a href="{{ env('URL_FRONT', 'evius.co') }}/landing/{{ $event->id }}"  class="btn btn-outline-danger" style="background-color: gray;">Evento</a>
            </div>

            <div id="cancel-payment-evius" style="display: none;">
                <div class="alert alert-danger" role="alert">
                    Orden Cancelada
                </div>
            </div>


            <div id="progress-payment-evius" style="display: none;">
                <div class="alert alert-primary" role="alert">
                    Estamos finalizando el proceso, esto puede tomar un tiempo. Por favor, Espera.
                </div>
            </div>

        </div>
        <div class="col-md-4">


        <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">

    </h5>
    <h6 class="card-subtitle mb-2 text-muted">Total</h6>
    <h4 class="card-title">{{ $ticket_order["currency"] }} ${{ $ticket_order["amount"] }}</h4>
    <h6 class="card-subtitle mb-2 text-muted">Id de la orden</h6>
    <p class="card-text">{{ $ticket_order["orderid"] }}</p>
    <h6 class="card-subtitle mb-2 text-muted">Descripción</h6>
    <p class="card-text">{{ $ticket_order["description"] }}</p>
    <h6 class="card-subtitle mb-2 text-muted">Documento</h6>
    <p class="card-text">{{ $ticket_order["typeDocument"] }} {{ $ticket_order["document"] }}</p>
    <h6 class="card-subtitle mb-2 text-muted">Nombre</h6>
    <p class="card-text">{{ $ticket_order["username"] }} {{ $ticket_order["lastname"] }} </p>
    <h6 class="card-subtitle mb-2 text-muted">Cédula</h6>
    <p class="card-text">{{ $ticket_order["document"] }}</p>
    <h6 class="card-subtitle mb-2 text-muted">Correo</h6>
    <p class="card-text">{{ $ticket_order["email"] }}</p>
  </div>
</div>



               <?php
// var_dump($ticket_order);
?>
            </h2>
        </div>
    </div>

</section>




