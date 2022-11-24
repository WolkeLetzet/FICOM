@extends('layouts.app')
@section('content')
<div class="container">
    <div style="background-color: #fff; border: solid black 1px; border-radius: 1rem">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">RUN</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Ver</th>
              </tr>
            </thead>
            <tbody>

              <tr class="table-light">
                <td>Mark</td>
                <td>Otto</td>
                <td>11111111-1</td>
                <td >Sin Beneficios</td>
              </tr>
              <tr class="table-primary">
                <td>Jacob</td>
                <td>Thornton</td>
                <td>11111111-1</td>
                <td >Prioritario</td>
              </tr>
              <tr class="table-danger">
                <td>Larry the Bird</td>
                <td>Thornton</td>
                <td>11111111-1</td>
                <td >Nuevo Prioritario</td>
              </tr>
            </tbody>
          </table>
    </div>

    <div class="container">
      <div class="grid">
        <div class="row">
          <div class="col">
            <pre>
            {{json_encode($estudiantes , JSON_PRETTY_PRINT); }}
            </pre>
          </div>
          <div class="col">
            <pre>
              {{json_encode($apoderados , JSON_PRETTY_PRINT); }}
            </pre>
          </div>
        </div>
      </div>
    </div>

</div>
@endsection