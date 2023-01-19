@extends('layouts.app')
@section('content')
<div class="container card">
    <pre>{{$estudiante}}</pre>
    <form method="POST" action="{{route('registrarPago', $estudiante->id)}}" class="mt-3 row">
        @csrf
        <h1>Registrar pago</h1>
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
            <select name="exencion" class="form-control">
                <option value="" selected hidden disabled>Selecciona una opción</option>
                <option value="">No</option>
                <option value="">Sí</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="meses" class="form-label">Meses</label>
            <select name="meses" class="form-control">
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
        <div class="form-group mb-3 col-6">
            <label for="documento" class="form-label">Documento</label>
            <select name="documento" class="form-control">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="">Boleta</option>
                <option value="">Recibo</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="numero_documento" class="form-label">N° Documento</label>
            <input type="text" name="numero_documento" class="form-control">
        </div>
        <div class="form-group mb-3 col-6">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control">
        </div>
        <div class="form-group mb-3 col-6">
            <label for="valor" class="form-label">Valor</label>
            <input type="text" name="valor" class="form-control">
        </div>
        <div class="form-group mb-3 col-6">
            <label for="f_pago" class="form-label">Forma de pago</label>
            <select name="f_pago" class="form-control">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="">Efectivo</option>
                <option value="">Cheque</option>
                <option value="">Transferencia</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>
    </form>
</div>

<div class="container mt-3">
    <table class="tabla-pagos table table-bordered border-dark">
        <thead>
          <tr>
            <th scope="col">Meses</th>
            <th scope="col">Documento</th>
            <th scope="col">N° Documento</th>
            <th scope="col">Fecha</th>
            <th scope="col">Valor</th>
            <th scope="col">Forma de pago</th>
            <th scope="col" style="width: 30%">Observaciones</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>Matrícula</td>
                <td class="text-center text-uppercase">boleta</td>
                <td class="text-center">123</td>
                <td class="text-center">dd/mm/aaaa</td>
                <td class="text-center">$3,500</td>
                <td class="text-center text-capitalize">cheque</td>
                <td>
                    N° cheque: 777777<br>
                    Titular: Simoncito Bolivar<br>
                    Banco: Santander
                </td>
            </tr>
            <tr>
                <td>Marzo</td>
                <td colspan="6">
                    <div class="multiples-pagos">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Abril</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Mayo</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Junio</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Julio</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Agosto</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Septiembre</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Octubre</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Noviembre</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Diciembre</td>
                <td class="text-center text-uppercase"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center text-capitalize"></td>
                <td>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection