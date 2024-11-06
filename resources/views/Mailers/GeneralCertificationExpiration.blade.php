<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>
        body {
            background-color: while;
        }
        .light {
            color: #D3D7DC;
        }
        .bold {
            font-weight: bold;
        }
        .centered-text {
            text-align: center;
        }
        .bg-blue {
            background-color: #0E3669;
        }
        .bordered {
            border: 1px solid black
        }
        .border-collapsed {
            border-collapse: collapse;
        }
    </style>

    <div class="centered">
        <h1>Vencimendo de certificación</h1>
    </div>

    <br />
    <br />

    <p>
        Hola, administrador de la organización {{ $organization["name"] }}, estos son las próximas certificaciones a vencer:
    </p>

    <table class="bordered border-collapsed" width="100%" cellpadding="0" cellspacing="0">
        <thead class="bordered border-collapsed bg-blue light">
            <tr>
                <td>
                    <strong>Usuario</strong>
                </td>
                <td>
                    <strong>Nombre del certificado</strong>
                </td>
                <td>
                    <strong>Fecha de vencimiento</strong>
                </td>
                <td>
                    <strong>Días</strong>
                </td>
            </tr>
        </thead>

        <tbody>
            @if($tomorrow_expiration && is_array($tomorrow_expiration))
            <tr class="bordered bg-blue light">
                <td colspan="4">Vencen mañana</td>
            </tr>
            @foreach($tomorrow_expiration as $data)
            <tr>
                <td>{{$data["user_name"]}}</td>
                <td>{{$data["certification_name"]}}</td>
                <td>{{$data["approved_until_date"]}}</td>
                <td>{{$data["diff_days"]}}</td>
            </tr>
            @endforeach
            @endif

            @if($week_expiration && is_array($week_expiration))
            <tr class="bordered bg-blue light">
                <td colspan="4">Vencen esta semana</td>
            </tr>
            @foreach($week_expiration as $data)
            <tr>
                <td>{{$data["user_name"]}}</td>
                <td>{{$data["certification_name"]}}</td>
                <td>{{$data["approved_until_date"]}}</td>
                <td>{{$data["diff_days"]}}</td>
            </tr>
            @endforeach
            @endif

            @if($month_expiration && is_array($month_expiration))
            <tr class="bordered bg-blue light">
                <td colspan="4">Vencen esta semana</td>
            </tr>
            @foreach($month_expiration as $data)
            <tr>
                <td>{{$data["user_name"]}}</td>
                <td>{{$data["certification_name"]}}</td>
                <td>{{$data["approved_until_date"]}}</td>
                <td>{{$data["diff_days"]}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>

        <tfoot class="bordered border-collapsed bg-blue light">
            <tr>
                <td colspan="4">
                    <strong class="centered-text">
                        Certificaciones en {{ $organization["name"] }}
                    </strong>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
