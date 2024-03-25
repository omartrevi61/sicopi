<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Proyecto</title>
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
              
    <table class="table table-bordered table-striped table-sm small">
        <thead>
            
        </thead>
        <tbody>
            <tr>
                <th>Proyecto: </th>
                <td>{{ $proyecto->proyecto }}</td>
            </tr>
            <tr>
                <th>Título: </th>
                <td>{{ $proyecto->titulo }}</td>
            </tr>
            <tr>
                <th>Responsable: </th>
                <td>{{ $proyecto->profesor->nombre_completo }}</td>
            </tr>
            <tr>
                <th>Departamento: </th>
                <td>{{ $proyecto->profesor->ubpp->nombre }}</td>
            </tr>
            <tr>
                <th>Aprobado: </th>
                <td>${{ number_format($proyecto->aprobado, 2) }}</td>
            </tr>
            <tr>
                <th>% Asignado: </th>
                <td>{{ number_format($proyecto->porcentaje) }} %</td>
            </tr>
            <tr>
                <th>Asignado: </th>
                <td>${{ number_format($proyecto->aprobado * $proyecto->porcentaje / 100, 2) }}</td>
            </tr>
            <tr>
                <th>Ejercido: </th>
                <td>${{ number_format($ejercido, 2) }}</td>
            </tr>
            <tr>
                <th>Disponible:</th>
                <td><b>${{ number_format(($proyecto->aprobado * $proyecto->porcentaje / 100) - $ejercido, 2) }}</b>
                al {{Carbon\Carbon::now()->format('d-m-Y H:i')}}</td>
            </tr>
       

           {{--  <tr>
                <th>Disponible al</th>
                <td></td>
            </tr>
            <tr>
                <td>{{Carbon\Carbon::now()->format('d-m-Y H:i')}}</td>
                <th>${{ number_format(($proyecto->aprobado * $proyecto->porcentaje / 100) - $ejercido, 2) }}</th>
            </tr> --}}
            
        </tbody>
    </table>

</html>