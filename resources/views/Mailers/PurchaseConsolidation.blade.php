<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Detalles de compra</h1>
    <p>Buen día, se ha realizado una nueva compra en Evius.</p>
    <br>
    <p>Fecha: {{ $billing['billing']['start_date'] }}</p>
    <p>Nombres: {{ $clientData['address']['name'] }} {{ $clientData['address']['last_name'] }}</p>
    <p>Identificación: {{ $clientData['address']['identification']['value'] }}  {{ $clientData['address']['identification']['type'] }}</p>
    <p>Teléfono: +{{ $clientData['address']['prefix'] }} {{ $clientData['address']['phone_number'] }}</p>
    <p>Email: {{ $clientData['address']['billing_email'] }}</p>
    <p>País: {{ $clientData['address']['country'] }}</p>
    <p>Ciudad: {{ $clientData['address']['city'] }}</p>
    <br>
    <p>Para mayor información, visite el <a href="https://docs.google.com/spreadsheets/d/1W3wumByrcdyTddenaba7WfkM9un28Zook0QSrcH5Do0/edit#gid=20602418">documento de compras</a>.</p>
</body>

</html>
