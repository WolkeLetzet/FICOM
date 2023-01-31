@extends('layouts.app')
@section('content')
@php if(session('res') && session('res')['status'] == 400) $beca = session('res')['beca']; @endphp
<div class="container card form-container">
    <form method="post" action="{{ route('updateBeca', $beca['id']) }}" id="formBeca" class="mt-3 row">
        @csrf
        <h2 class="form-title">Beca</h2>
        
        <div class="form-group mb-3 col-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="{{$beca['nombre']}}" disabled>
        </div>

        <div class="form-group mb-3 col-6">
            <label class="form-label" for="descuento">% Descuento</label>
            <input class="form-control" type="number" id="descuento" name="descuento" value="{{$beca['descuento']}}" min="0" max="100" disabled>
        </div>

        <div class="form-group mb-3 col-12">
            <label class="form-label" for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" disabled>{{$beca['descripcion']}}</textarea>
        </div>

        @if(Auth::user()->hasAnyRole('admin', 'contabilidad'))
            <div class="buttons mb-3">
                <button type="button" id="btn-editar" class="btn btn-secondary" onclick="editar()">Editar</button>
                <button type="button" id="btn-cancelar" class="btn btn-danger" onclick="cancelEditar()" hidden>Cancelar</button>
                <button type="submit" id="btn-enviar" class="btn btn-primary" hidden>Guardar</button>
            </div>
        @endif
    </form>
</div>
<script>
    const btneditar = document.getElementById('btn-editar');
    const cancelar = document.getElementById('btn-cancelar');
    const enviar = document.getElementById('btn-enviar');

    //Campos beca
    const nombre = document.getElementById('nombre');
    const descuento = document.getElementById('descuento');
    const descripcion = document.getElementById('descripcion');
    
    function editar() {
        btneditar.hidden = true;
        cancelar.hidden = false;
        enviar.hidden = false;
        enableInput();
    }

    function cancelEditar() {
        btneditar.hidden = false;
        cancelar.hidden = true;
        enviar.hidden = true;
        disableInput();
    }

    function enableInput() {
        nombre.disabled = false;
        descuento.disabled = false;
        descripcion.disabled = false;
    }

    function disableInput() {
        nombre.disabled = true;
        descuento.disabled = true;
        descripcion.disabled = true;
    }
</script>
@endsection