@extends('layouts.app')
@section('content')
@php if(session('res') && session('res')['status'] == 400) $cursoErr = session('res')['cursoErr']; @endphp
<div class="container card form-container">
    <form method="post" action="{{ route('curso.update', $curso->id) }}" id="formCurso" class="mt-3 row">
        @csrf
        <h2 class="form-title">{{ $curso->curso . '-' . $curso->paralelo }}</h2>
        
        <div class="form-group mb-3 col-12">
            <label class="form-label" for="arancel">Arancel</label>
            <input type="number" class="form-control" id="arancel" name="arancel" value="{{isset($cursoErr) ? $cursoErr['arancel'] : $curso->arancel}}" />
        </div>

        <div class="buttons mb-3">
            <button type="submit" id="btn-enviar" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection