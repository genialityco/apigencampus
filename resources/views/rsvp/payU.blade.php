@component('mail::message')  
<div class="centered">
    <p style="font-size: 20px;color: gray;font-style: italic">
        ¡Felicitaciones! tu compra ha sido exitosa                      
    </p>
</div>
<div>
    <p style="text-align:left; width: 100%;">
        <strong>FECHA Y HORA</strong> {{$payU['transaction_date']}}
        <br />
        <strong>REFERENCIA PAYU:</strong> {{ $referencePayu }}   
        <br /> 
        <strong>REFERENCIA:</strong> {{ $order->_id }}
        <br />
        <strong>CÓDIGO DE LA TRANSACCIÓN:</strong> {{ $payU['transaction_id'] }}
        <br />
        <strong>CORREO ELECTRÓNICO:</strong> {{ $order->email }}  
        <br />
        <strong>TIPO DE COMPRA:</strong>
        @if($order->item_type == 'discountCode')
            Compra de códigos de descuento
        @else
            Compra de cursos
        @endif
        <br />
        <strong>MÉTODO DE PAGO:</strong> {{$payU['payment_method_name']}}
        <br />
        <strong>VALOR:</strong> ${{$payU['value']}}   
        <br />           
    </p>
</div>  
@endcomponent