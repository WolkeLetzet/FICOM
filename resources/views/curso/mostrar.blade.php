@extends('layouts.app')
@section('content')
@php if(session('res') && session('res')['status'] == 400) $cursoErr = session('res')['cursoErr']; @endphp
<div class="container card form-container">
    <form method="post" action="{{ route('curso.update', $curso->id) }}" id="formCurso" class="mt-3 row">
        @csrf
        <h2 class="form-title">{{ $curso->curso . '-' . $curso->paralelo }}</h2>
        
        <div class="form-group mb-3 col-12">
            <label class="form-label" for="arancel">Arancel</label>
            <input type="number" class="form-control" id="arancel" name="arancel" value="{{isset($cursoErr) ? $cursoErr['arancel'] : $curso->arancel}}" disabled />
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

    //Campos
    const arancel = document.getElementById('arancel');
    
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
        arancel.disabled = false;
    }

    function disableInput() {
        arancel.disabled = true;
    }
</script>
@endsection