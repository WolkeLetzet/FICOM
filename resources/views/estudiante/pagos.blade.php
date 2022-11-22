@extends('layouts.app')
@section('content')
<div class="content">
    <form class="col-md-10 mt-3 row">
        <h1>Pagos</h1>
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
                <option value="">Matricula</option>
                <option value="">Marzo</option>
                <option value="">Abril</option>
                <option value="">Mayo</option>
                <option value="">Junio</option>
                <option value="">Julio</option>
                <option value="">Agosto</option>
                <option value="">Septiembre</option>
                <option value="">Octubre</option>
                <option value="">Noviembre</option>
                <option value="">Diciembre</option>
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
@endsection