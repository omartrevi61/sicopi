<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Estado Presupuestal</title>
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
            <h6>ESTADO PRESUPUESTAL DE PROYECTOS POR CENTRO</h6>
        </div>
    </div>

    {{-- <h6 class="text-center">Universidad Autónoma Chapingo</h6>
    <h6 class="text-center">Dirección General de Investigación y Posgrado</h6>
    <h6 class="text-center">Jefatura Administrativa</h6>
    <h6 class="text-center">Estado Presupuestal de Proyectos</h6> --}}
 
    @php
        $m_centro = 0;
        $m_ejercido = 0;
        $m_disponible = 0;
    @endphp
    
    <table class="table table-bordered table-sm small">
        <thead>
            <tr style="text-align:center">
                <th style="width:12%">Proyecto</th>
                <th>Título</th>
                <th>Responsable</th>
                <th style="width:12%">Asignado</th>
                <th style="width:10%">Ejercido</th>
                <th style="width:12%">Disponible</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($proyectos as $proyecto)
                
                @if($proyecto->centro_id === $m_centro)
                    
                @else
                    @php
                        $m_centro = $proyecto->centro_id;
                    @endphp

                    <tr><th colspan="6">Centro: {{ $proyecto->centro->nombre }}</th></tr>
                    
                @endif

                <tr>
                    <td>{{ $proyecto->proyecto }}</td>
                    <td>{{ $proyecto->titulo }}</td>
                    <td>{{ $proyecto->profesor->nombre . " " . $proyecto->profesor->apellidos }}</td>
 
                    <td style="text-align:right">${{ number_format($proyecto->asignado,2) }}</td>  {{-- atributo definido en el modelo --}}
                    <td style="text-align:right">${{ number_format($proyecto->documentos_sum_importe,2) }}</td>
                    <td style="text-align:right">${{ number_format($proyecto->asignado - $proyecto->documentos_sum_importe,2) }}</td>  {{-- atributo definido en el modelo --}}

                </tr>

                @php
                    $m_ejercido = $m_ejercido + $proyecto->documentos_sum_importe;
                    $m_disponible = $m_disponible + ($proyecto->asignado - $proyecto->documentos_sum_importe);

                 @endphp
            @endforeach
            <tr>
                <th style="text-align:right" colspan="3">Totales</th>
                <th style="text-align:right">${{ number_format($proyectos->sum('asignado'),2) }}</th>
                <th style="text-align:right">${{ number_format($m_ejercido,2) }}</th>
                <th style="text-align:right">${{ number_format($m_disponible,2) }}</th>

            </tr>
        </tbody>
    </table>
  
</body>
</html>