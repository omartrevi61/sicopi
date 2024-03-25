<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>ContraRecibo</title>
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
        </div>
    </div>

      {{-- <h6 class="text-center">Universidad Autónoma Chapingo</h6>
      <h6 class="text-center">Dirección General de Investigación y Posgrado</h6>
      <h6 class="text-center">Jefatura Administrativa</h6>   --}} 
              
    <table class="table table-bordered table-sm small">
        <thead>
            
        </thead>
        <tbody>
            <tr>
                <th>ContraRecibo: {{ $recibo->id }}</th>
                <td>Fecha: {{ $recibo->fecha }}</td>
                <th>{{ $recibo->tipo_pago->nombre }}</th>
            </tr>
            <tr>
                <th>Proyecto: {{ $recibo->proyecto->proyecto }}</th>
                <td>Presupuestal: {{ $recibo->proyecto->centro->proy_ptal }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">Responsable: {{ $recibo->proyecto->profesor->nombre_completo }}</td>
                <td>Teléfono: {{ $recibo->proyecto->profesor->telefono }}</td>
            </tr>
            <tr>
                <td colspan="3">Centro: {{ substr($recibo->proyecto->centro->nombre, 0,70) }}</td>
            </tr>
            <tr>
                <td colspan="3">Departamento: {{ $recibo->proyecto->centro->ubpp->nombre }}</td>
            </tr>
            <tr>
                <td colspan="3">Beneficiario: {{ $recibo->beneficiario }}</td>
            </tr>
        </tbody>
    </table>

    @php
        $total = 0;
    @endphp

    <table class="table table-bordered table-sm small">
        <thead>
            <tr class="table-primary">
                <th style="width:15%">Factura</th>
                <th style="width:30%">Proveedor</th>
                <th style="width:40%">Concepto</th>
                <th style="text-align:center">Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->factura }}</td>
                    <td>{{ $documento->provedor->nombre }}</td>
                    <td>{{ $documento->concepto }}</td>
                    <td style="text-align:right">${{ number_format($documento->importe,2) }}</td>
                    
                </tr>
                @php
                    $total = $total + $documento->importe;
                @endphp
            @endforeach
            <tr>
                <th style="text-align:right" colspan="3">Total Amparado</th>
                <th style="text-align:right">${{ number_format($total,2) }}</th>
            </tr>
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <td colspan="2">Elaboró: {{ $recibo->user->name }}</td>
                <td colspan="2">Recibo Documentación Sujeta a Revisión</td>
            </tr>
        </tfoot>
    </table>
</html>