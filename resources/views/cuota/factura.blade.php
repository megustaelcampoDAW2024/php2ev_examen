<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Cuota #{{ $cuota->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ccc;
        }
        .details {
            margin-top: 20px;
        }
        .item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
            <p>Cuota #{{ $cuota->id }}</p>
        </div>
        <div class="details">
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th colspan="2">Información del Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>{{ $cuota->cliente->nombre }}</td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td>{{ $cuota->cliente->telefono }}</td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td>{{ $cuota->cliente->correo }}</td>
                    </tr>
                    <tr>
                        <td>País</td>
                        <td>{{ $cuota->cliente->pais->nombre }}</td>
                    </tr>
                </tbody>
            </table>
            <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th colspan="2">Información de la Cuota</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nota</td>
                        <td>{{ $cuota->notas }} uds.</td>
                    </tr>
                    <tr>
                        <td>Concepto</td>
                        <td>{{ $cuota->concepto }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de Emisión</td>
                        <td>{{ $cuota->fecha_emision }}</td>
                    </tr>
                    <tr>
                        <td>Importe</td>
                        <td>{{ $cuota->importe }} {{ $cuota->moneda }}</td>
                    </tr>
                    <tr>
                        <td>Importe €<br>(Puede Cambiar)</td>
                        <td>{{ $importe_euro }} €</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>