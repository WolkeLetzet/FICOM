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
                @switch ($estud->prioridad)
                  @case(1)
                    class="table-light"
                    @break
                  
                  @case(2)
                    class="table-danger"
                    @break
                  
                  @case(3)
                    class="table-primary"
                    @break
                @endswitch
              >
                <td>{{$estud->nombres}}</td>
                <td>{{$estud->apellidos}}</td>
                <td>{{$estud->rut}}</td>
                <td>
                  @switch ($estud->prioridad)
                    @case(1)
                      Sin Beneficios
                      @break
                    
                    @case(2)
                      Nuevo Prioritario
                      @break
                    
                    @case(3)
                      Prioritario
                      @break
                  @endswitch
                </td>
                <td>
                  <a href="estudiante/{{$estud->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                  </a>
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
</div>
@endsection