<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Reporte de ContraRecibos</title>
</head>
<body>
    <div class="d-flex">
        <div class="float-right">
            <img src="{{ asset('/images/uach2.bmp')}}" alt="">
        </div>
        <div class="align-items-center d-flex  p-2">
            <h6>Universidad Autónoma Chapingo</h6>
            <h6>Dirección General de Investigación y Posgrado</h6>
            <h6>Jefatura Administrativa</h6>
            <h6>RELACIÓN DE CONTRA-RECIBOS</h6>
        </div>
    </div>
 
    @php
        $total = 0;
    @endphp
    
    <table class="table table-bordered table-sm small">
        <thead>
            <tr style="text-align:center">
                <th style="width:08%">CR</th>
                <th style="width:10%">Fecha</th>
                <th>Beneficiario</th>
                <th style="width:15%">Tipo Pago</th>
                <th style="width:15%">Proyecto</th>
                <th>Responsable</th>
                <th style="width:12%">Total CR</th>               
            </tr>
        </thead>
        <tbody>

            @foreach ($recibos as $recibo)
                
                {{-- @if($proyecto->tipo_proyecto_id === $tipo)
                    
                @else
                    @php
                        $tipo = $proyecto->tipo_proyecto_id;
                    @endphp
                    
                    <tr><th colspan="6">Proyectos {{ $proyecto->tipo_proyecto->nombre}}</th></tr>

                @endif --}}

                <tr>
                    <td style="text-align:center">{{ $recibo->id }}</td>
                    <td style="text-align:center">{{ $recibo->fecha->format('d-m-Y') }}</td>
                    <td>{{ $recibo->beneficiario }}</td>
                    <td>{{ $recibo->tipo_pago->nombre }}</td>
                    <td>{{ $recibo->proyecto->proyecto }}</td>
                    <td>{{ $recibo->proyecto->profesor->nombre . " " . $recibo->proyecto->profesor->apellidos }}</td>
                    <td style="text-align:right">${{ number_format($recibo->documentos_sum_importe,2) }}</td>
                </tr>

                @php
                    $total = $total + $recibo->documentos_sum_importe;
                 @endphp
            @endforeach
            <tr>
                <th style="text-align:right" colspan="6">Total</th>
                <th style="text-align:right">${{ number_format($total,2) }}</th>

                {{-- <th style="text-align:right">${{ number_format($proyectos->sum('asignado'),2) }}</th> --}}
            </tr>
        </tbody>
    </table>
  
</body>
</html>