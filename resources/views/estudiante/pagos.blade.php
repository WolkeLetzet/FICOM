@extends('layouts.app')
@section('content')
<div class="container card">
    <form method="POST" action="{{route('registrarPago', $estudiante->id)}}" id="formPago" class="mt-3 row">
        @csrf
        <h2>Registrar pago</h2>
        {{--
        <div class="form-group mb-3 col-4">
            <label for="monto_mensual" class="form-label">Monto mensualidad</label>
            <input type="text" name="monto_mensual" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="beca" class="form-label">% Beca</label>
            <input type="text" name="beca" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="exencion" class="form-label">Exencion</label>
            <select name="exencion" class="form-control form-select">
                <option value="" selected hidden disabled>Selecciona una opción</option>
                <option value="">No</option>
                <option value="">Sí</option>
            </select>
        </div>
        --}}
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="mes" class="form-label">Mes</label>
            <select name="mes" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="matricula">Matrícula</option>
                <option value="marzo">Marzo</option>
                <option value="abril">Abril</option>
                <option value="mayo">Mayo</option>
                <option value="junio">Junio</option>
                <option value="julio">Julio</option>
                <option value="agosto">Agosto</option>
                <option value="septiembre">Septiembre</option>
                <option value="octubre">Octubre</option>
                <option value="noviembre">Noviembre</option>
                <option value="diciembre">Diciembre</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="anio" class="form-label">Año</label>
            <select name="anio" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="documento" class="form-label">Documento</label>
            <select name="documento" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="boleta">Boleta</option>
                <option value="recibo">Recibo</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="fecha_pago" class="form-label">Fecha</label>
            <input type="date" name="fecha_pago" class="form-control">
        </div>
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" name="valor" class="form-control">
        </div>
        <div class="form-group mb-3 col-6 col-md-4">
            <label for="forma" class="form-label">Forma de pago</label>
            <select name="forma" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="efectivo">Efectivo</option>
                <option value="cheque">Cheque</option>
                <option value="transferencia">Transferencia</option>
            </select>
        </div>
        <div class="form-group mb-3 col-12 col-md-6">
            <label for="observacion" class="form-label">Observaciones</label>
            <textarea name="observacion" class="form-control"></textarea>
        </div>
        <div>
            <button class="btn btn-primary">Enviar</button>
            <button type="button" class="btn btn-danger" onclick="cancelForm()">Cancelar</button>
        </div>
    </form>
</div>

<div class="container mt-3">
    <div class="tabla-pagos-container">
        <table class="tabla-pagos table table-bordered border-dark">
            <thead>
              <tr>
                <th scope="col" style="width: 123px">Meses</th>
                <th scope="col" style="width: 123px">Documento</th>
                <th scope="col" style="width: 150px">N° Documento</th>
                <th scope="col" style="width: 120px">Fecha</th>
                <th scope="col" style="width: 130px">Valor</th>
                <th scope="col" style="width: 150px">Forma de pago</th>
                <th scope="col" style="width: auto">Observaciones</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Matrícula</td>
                    @if(count($estudiante->pagos_anio['matricula']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['matricula'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['matricula']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['matricula'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Marzo</td>
                    @if(count($estudiante->pagos_anio['marzo']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['marzo'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['marzo']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['marzo'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Abril</td>
                    @if(count($estudiante->pagos_anio['abril']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['abril'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['abril']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['abril'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Mayo</td>
                    @if(count($estudiante->pagos_anio['mayo']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['mayo'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['mayo']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['mayo'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Junio</td>
                    @if(count($estudiante->pagos_anio['junio']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['junio'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['junio']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['junio'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Julio</td>
                    @if(count($estudiante->pagos_anio['julio']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['julio'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['julio']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['julio'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Agosto</td>
                    @if(count($estudiante->pagos_anio['agosto']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['agosto'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['agosto']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['agosto'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Septiembre</td>
                    @if(count($estudiante->pagos_anio['septiembre']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['septiembre'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['septiembre']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['septiembre'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Octubre</td>
                    @if(count($estudiante->pagos_anio['octubre']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['octubre'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['octubre']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['octubre'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Noviembre</td>
                    @if(count($estudiante->pagos_anio['noviembre']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['noviembre'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['noviembre']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['noviembre'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
                <tr>
                    <td>Diciembre</td>
                    @if(count($estudiante->pagos_anio['diciembre']) > 1)
                        <td class="multiples-pagos" colspan="6">
                            @foreach($estudiante->pagos_anio['diciembre'] as $pago)
                                <div class="detalles">
                                    <div class="text-uppercase" style="width: 123px">{{ $pago['documento'] }}</div>
                                    <div style="width: 150px">{{ $pago['id'] }}</div>
                                    <div style="width: 120px">{{ $pago['fecha_pago'] }}</div>
                                    <div style="width: 130px">{{ $pago['valor'] }}</div>
                                    <div class="text-capitalize" style="width: 150px">{{ $pago['forma'] }}</div>
                                    <div style="width: auto">{{ $pago['observacion'] }}</div>
                                </div>
                            @endforeach
                        </td>
                    @elseif(count($estudiante->pagos_anio['diciembre']) == 0)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach ($estudiante->pagos_anio['diciembre'] as $pago)    
                            <td class="text-center text-uppercase">{{$pago['documento']}}</td>
                            <td class="text-center">{{$pago['id']}}</td>
                            <td class="text-center">{{$pago['fecha_pago']}}</td>
                            <td class="text-center">{{$pago['valor']}}</td>
                            <td class="text-center text-capitalize">{{$pago['forma']}}</td>
                            <td>{{$pago['observacion']}}</td>
                        @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    function cancelForm() {
        const form = document.getElementById('formPago');
        form.reset();
    }
</script>