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
              @foreach ($estudiantes as $estud)
                
              
              <tr 
              @if ($estud->prioridad == 1)
                class="table-light"
              @elseif ($estud->prioridad == 2)
                class="table-danger"
              @elseif ($estud->prioridad == 3)
                class="table-primary"
              @endif>
                <td>{{$estud->nombres}}</td>
                <td>{{$estud->apellidos}}</td>
                <td>{{$estud->rut}}</td>
                <td >
                  @if ($estud->prioridad == 1)
                    Sin Beneficios
                  @elseif ($estud->prioridad == 2)
                    Nuevo Prioritario
                  @elseif ($estud->prioridad == 3)
                    Prioritario
                  @endif
                </td>
                <td>
                  <button class="btn btn-primary">
                    <i class="bi bi-person"></i>
                  </button>
                </td>
              </tr>
              @endforeach
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