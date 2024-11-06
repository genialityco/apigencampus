<table>
    <thead>
        <tr>
            <th><strong>Nombres</strong></th>
            <th><strong>Correo electrónico</strong></th>
            <th><strong>Paquete adquirido</strong></th>
            <th><strong>Codígo</strong></th>
            <th><strong>Estado</strong></th>
            <th><strong>Valor en USD</strong></th>
            <th><strong>Valor en COP</strong></th>
            <th><strong>Tipo de documento</strong></th>
            <th><strong>No. de documento</strong></th>
            <th><strong>Fecha de compra</strong></th>
            <th><strong>Email de compra</strong></th>
            <th><strong>Nombre de Comprador</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($burnedTickets as $burnedTicket)
            <tr>
                <td>{{ $burnedTicket->assigned_to['name'] }}</td>
                <td>{{ $burnedTicket->assigned_to['email'] }}</td>
                <td>{{ $burnedTicket->ticketCategory->name['es'] }}</td>
                <td>{{ $burnedTicket->code }}</td>
                <td>{{ $burnedTicket->state }}</td>
                <td>${{ $burnedTicket->price_usd }}</td>
                <td>${{ $burnedTicket->amount_in_cents / 100 }}</td>
                <td>{{ $burnedTicket->assigned_to['document']['type_doc'] }}</td>
                <td>{{ $burnedTicket->assigned_to['document']['value'] }}</td>
                <td>{{ $burnedTicket->created_at }}</td>
                <td>{{ $burnedTicket->billing['data']['transaction']['customer_email'] }}</td>
                <td>{{ $burnedTicket->billing['data']['transaction']['customer_data']['full_name'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
