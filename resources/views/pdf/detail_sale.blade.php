<!DOCTYPE html>
<html>

<head>
    <title>Detalle venta</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        @page {
            margin-top: 40px;
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

   
    </style>
</head>
<header style="padding-bottom: 20px; border-bottom: 2px solid #ccc; margin-bottom: 20px;">
    <div style="margin-left: 20px;">
        <h2 style="margin: 0;">Nombre de la Empresa</h2>
        <p style="margin: 0;">Dirección de la Empresa</p>
        <p style="margin: 0;">Ciudad, Estado, Código Postal</p>
        <p style="margin: 0;">Teléfono: 123-456-7890</p>
        <p style="margin: 0;">Correo electrónico: info@empresa.com</p>
    </div>
</header>
<body style="position: relative;">
    <img src="{{ $Isotipo }}" alt="Isotipo" style="width: 200px; height: auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2;">
    <main>
        <h2>Detalle venta</h2>
        <p>Fecha de venta: {{ $saleDetail->first()->formatted_updated_at }}</p>
        <p>Folio de Venta: {{ $saleDetail->first()->sale_id }}</p>
        <p>Vendido por: {{ $saleDetail->first()->user_name }}</p>
        <table class="table">
            <thead>
                <tr>
                 
                    <th>SKU</th>
                    <th>Cantidad</th>
                    <th>Nombre</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                   
                </tr>
            </thead>
            <tbody>
                @php
                $totalPrice = 0;
            @endphp
                @foreach ($saleDetail as $detail)
                <tr>
                    <td>{{$detail->product_sku}}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->unit_price }}</td>
                    <td>${{ $detail->total_price }}</td>
                    @php
                    $totalPrice += $detail->total_price;
                @endphp
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;">Total:</td>
                    <td>${{ $totalPrice }}</td>
                </tr>
            </tfoot>
        </table>
    </main>
    
 
    
</body>
   <footer style="position: fixed; bottom: 5px; left: 0; right: 0; text-align: center; font-style: italic; color: #777;">
        Desarrollado por Guiseo &copy; {{ date('Y') }}
    </footer>
</html>
