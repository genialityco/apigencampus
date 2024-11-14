<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de Expiración de Membresía</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1>Estimado miembro de la comunidad ACE,</h1>

    <p>
        @if ($notificationType === 'Proximidad de expiración')
            ¡Tu membresía de ENDOCAMPUS está por vencerse!
        @else
            Tu membresía de ENDOCAMPUS ha vencido.
        @endif
    </p>

    <p>Fecha de vencimiento membresía: <strong>{{ \Carbon\Carbon::parse($plan->date_until)->format('d/m/Y') }}</strong></p>

    <p>
        Desde la Asociación Colombiana de Endocrinología, Diabetes y Metabolismo queremos invitarte a reactivar tu membresía y redescubrir los
        simposios académicos especializados en Endocrinología que hemos preparado para ti.
    </p>

    <p>
        No pierdas la oportunidad de enriquecer tus conocimientos y mantenerte al día en las últimas tendencias de la Endocrinología.
    </p>

    <p>¡Te esperamos de vuelta!</p>

    <p style="text-align: center; margin: 20px 0;">
        <a href="{{ $authLink }}" style="background-color: #1E90FF; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Activa nuevamente tu membresía aquí
        </a>
    </p>

    <p>Saludos cordiales,<br>
    Equipo de Endocampus<br>
    Asociación Colombiana de Endocrinología, Diabetes y Metabolismo</p>
</body>
</html>
