@extends('layouts.app')
@section('content')
    <div class="container card" id="table">
        <table class="table">
            <tbody>
                <nav class="navbar navbar-expand-lg">
                    <form class="d-flex navbar-nav ms-auto">
                        <div>
                            <select class="form-select" name="perPage" id="curso-select">
                                <option value="10" @if ($perPage == 10) selected @endif>10</option>
                                <option value="15" @if ($perPage == 15) selected @endif>15</option>
                                <option value="20" @if ($perPage == 20) selected @endif>20</option>
                            </select>
                        </div>
                        <div>
                            <select class="form-select" name="curso" id="curso-select">
                                <option selected value="todos">Todos</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->curso . '-' . $curso->paralelo }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <input class="form-control me-2" name='search' type="search" placeholder="Buscar"
                                aria-label="Buscar">
                        </div>


                        <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </form>
                </nav>
            </tbody>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">RUN</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($estudiantes as $estud)
                    <tr
                        @switch ($estud->prioridad) @case('Sin Beneficios')
                    class="table-light"
                    @break
                  
                  @case('Prioritario')
                    class="table-danger"
                    @break
                  
                  @case('Nuevo Prioritario')
                    class="table-primary"
                    @break @endswitch>
                        <td>{{ $estud->nombres }}</td>
                        <td>{{ $estud->apellidos }}</td>
                        <td>{{ $estud->rut . '-' . $estud->dv }}</td>
                        <td>{{ $estud->prioridad }}</td>
                        <td>
                            @if (isset($estud->curso))
                                {{ $estud->curso->curso . '-' . $estud->curso->paralelo }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('showEstudiante', $estud->id) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </a>
                        </td>
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $estudiantes->links() }}
        </div>

    </div>
    </div>

    <style lang="scss">
        div.container#table {
            min-height: 500px
        }
    </style>

    <script></script>
@endsection
