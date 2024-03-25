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
            <h6>CONTRA-RECIBOS A NIVEL DETALLE</h6>
        </div>
    </div>
 
    @php
        $m_total = 0;
    @endphp
    
    <table class="table table-bordered table-sm small">
        <thead>
            <tr style="text-align:center">
                <th style="width:08%">CR</th>
                <th style="width:10%">Fecha</th>
                <th>Beneficiario</th>
                <th style="width:12%">Proyecto</th>   
                <th style="width:15%">* Documento *</th>
                <th>* Proveedor *</th>
                <th style="width:12%">* Importe *</th>
                <th style="width:12%">Total CR</th>              
            </tr>
        </thead>
        <tbody>

            @foreach ($recibos as $recibo)

                <tr>
                    <td style="text-align:center">{{ $recibo->id }}</td>
                    <td style="text-align:center">{{ $recibo->fecha->format('d-m-Y') }}</td>
                    <td>{{ $recibo->beneficiario }}</td>
                    <td style="text-align:center">{{ $recibo->proyecto->proyecto }}</td>

                    @foreach ($recibo->documentos as $docto)
                        @if ($loop->first)
                            <td style="text-align:center">{{ $docto->factura }}</td>
                            <td>{{ $docto->provedor->nombre }}</td>
                            <td style="text-align:right">${{ number_format($docto->importe,2) }}</td>

                            @if ($loop->count == 1)
                                <th style="text-align:right">${{ number_format($recibo->documentos_sum_importe,2) }}</th>
                            @else
                                <td></td>
                            @endif
                        @else
                            <tr>
                                <td colspan="4"></td>
                                <td style="text-align:center">{{ $docto->factura }}</td>
                                <td>{{ $docto->provedor->nombre }}</td>
                                <td style="text-align:right">${{ number_format($docto->importe,2) }}</td>

                                @if ($loop->last)
                                    <th style="text-align:right">${{ number_format($recibo->documentos_sum_importe,2) }}</th>
                                @endif
                            </tr>
                        @endif

                        @php
                            $m_total = $m_total + $docto->importe;
                        @endphp
                    @endforeach
                </tr>

            @endforeach
            <tr>
                <th style="text-align:right" colspan="7">Total</th>
                <th style="text-align:right">${{ number_format($m_total,2) }}</th>
            </tr>
        </tbody>
    </table>
  
</body>
</html>