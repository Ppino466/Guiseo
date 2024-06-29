<!DOCTYPE html>
<html>

<head>
    <title>Meta Actualizada</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            padding-bottom: 20px;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }

        header div {
            margin-left: 20px;
        }

        header h2 {
            margin: 0;
        }

        header p {
            margin: 0;
        }

        main {
            padding: 0 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        footer {
            position: fixed;
            bottom: 5px;
            left: 0;
            right: 0;
            text-align: center;
            font-style: italic;
            color: #777;
            padding-top: 10px;
        }

        .logo {
            width: 200px;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.2;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <h2>Nombre de la Empresa</h2>
            <p>Dirección de la Empresa</p>
            <p>Ciudad, Estado, Código Postal</p>
            <p>Teléfono: 123-456-7890</p>
            <p>Correo electrónico: info@empresa.com</p>
        </div>
    </header>

    <img src="{{ asset('path/a/tu/imagen.jpg') }}" alt="Isotipo" class="logo">

    <main>
        <h2>Detalle de Meta Actualizada</h2>

        <h3>Datos Previos:</h3>
        <p>Descripción Anterior: {{ $previousData->description }}</p>
        <p>Tipo Anterior: {{ $previousData->type }}</p>
        <p>Monto Anterior: ${{ number_format($previousData->amount, 2) }}</p>
        <p>Fecha de Inicio Anterior: {{ $previousData->start_date }}</p>
        <p>Fecha de Fin Anterior: {{ $previousData->end_date }}</p>

        <hr>

        <h3>Datos Actualizados:</h3>
        <p>Nueva Descripción: {{ $updatedData->description }}</p>
        <p>Nuevo Tipo: {{ $updatedData->type }}</p>
        <p>Nuevo Monto: ${{ number_format($updatedData->amount, 2) }}</p>
        <p>Nueva Fecha de Inicio: {{ $updatedData->start_date }}</p>
        <p>Nueva Fecha de Fin: {{ $updatedData->end_date }}</p>
    </main>

        <footer>
            Desarrollado por Guiseo &copy; {{ date('Y') }}
        </footer>
</body>

</html>
