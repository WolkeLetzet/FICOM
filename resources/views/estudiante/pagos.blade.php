@extends('layouts.app')
@section('content')
<div class="container card">
    <form method="POST" action="{{route('registrarPago', $estudiante->id)}}" id="formPago" class="mt-3 row">
        @csrf
        <h2>Registrar pago</h2>
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
        <div class="form-group mb-3 col-4">
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
        <div class="form-group mb-3 col-4">
            <label for="anio" class="form-label">Año</label>
            <select name="anio" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="documento" class="form-label">Documento</label>
            <select name="documento" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="boleta">Boleta</option>
                <option value="recibo">Recibo</option>
            </select>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="fecha_pago" class="form-label">Fecha</label>
            <input type="date" name="fecha_pago" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" name="valor" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
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
                    <td class="text-center text-uppercase">boleta</td>
                    <td class="text-center">123</td>
                    <td class="text-center">dd/mm/aaaa</td>
                    <td class="text-center">$300,500</td>
                    <td class="text-center text-capitalize">cheque</td>
                    <td>
                        N° cheque: 777777<br>
                        Titular: Simoncito Bolivar<br>
                        Banco: Santander
                    </td>
                </tr>
                <tr>
                    <td>Marzo</td>
                    <td class="multiples-pagos" colspan="6">
                        <div class="detalles">
                            <div class="text-uppercase" style="width: 123px">boleta</div>
                            <div style="width: 150px">123</div>
                            <div style="width: 120px">dd/mm/aaaa</div>
                            <div style="width: 130px">$4000</div>
                            <div class="text-capitalize" style="width: 150px">cheque</div>
                            <div style="width: auto">texto texto texto</div>
                        </div>
                        <div class="detalles">
                            <div class="text-uppercase" style="width: 123px">boleta</div>
                            <div style="width: 150px">123</div>
                            <div style="width: 120px">dd/mm/aaaa</div>
                            <div style="width: 130px">$4000</div>
                            <div class="text-capitalize" style="width: 150px">cheque</div>
                            <div style="width: auto">texto texto texto</div>
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
</div>
@endsection

<script>
    function cancelForm() {
        const form = document.getElementById('formPago');
        form.reset();
    }
</script>