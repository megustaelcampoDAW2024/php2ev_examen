<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Cuota</title>
</head>
<body>
    <p>Estimado/a {{ $cuota->cliente->nombre }},</p>
    <p>Adjunto encontrará la factura correspondiente a su cuota.</p>
    <p>Gracias por su confianza.</p>
</body>
</html>