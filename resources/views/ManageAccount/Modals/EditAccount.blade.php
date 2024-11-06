<div role="dialog"  class="modal fade" style="display: none;">
    <style>
        .account_settings .modal-body {
            border: 0;
            margin-bottom: -35px;
            border: 0;
            padding: 0;
        }

        .account_settings .panel-footer {
            margin: -15px;
            margin-top: 20px;
        }

        .account_settings .panel {
            margin-bottom: 0;
            border: 0;
        }
    </style>
    <div class="modal-dialog account_settings">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cogs"></i>
                    Información de los tiquetes</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- tab -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#payment_account" data-toggle="tab">@lang("ManageAccount.payment")</a></li>
                            <li><a href="#tickets_promocional" data-toggle="tab">Tiquetes promocionales</a></li>
                            <li><a href="#codes_promocional" data-toggle="tab">códigos promocionales</a></li>
                            <li><a href="#seats_configuration" data-toggle="tab">Configuración de asientos</a></li>
                            <li><a href="#advanced_configuration" data-toggle="tab">Configuración avanzada</a></li>
                        </ul>
                        <div class="tab-content panel">
                            <div class="tab-pane active" id="payment_account">
                                @include('ManageAccount.Partials.PaymentGatewayOptions')
                            </div>
                            <div class="tab-pane" id="tickets_promocional">
                                @include('ManageAccount.Partials.TicketsPromocional')
                            </div>

                            <div class="tab-pane" id="codes_promocional">
                                @include('ManageAccount.Partials.CodesPromocional')
                            </div>
                            <div class="tab-pane" id="seats_configuration">
                                @include('ManageAccount.Partials.seats_configuration')
                            </div>
                            <div class="tab-pane" id="advanced_configuration">
                                @include('ManageAccount.Partials.AdvancedConfiguration')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>



</script>