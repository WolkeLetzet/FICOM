@extends('layouts.app')
@section('content')
@php if(session('res') && session('res')['status'] == 400) $beca = session('res')['beca']; @endphp
<div class="container card form-container">
    <form method="post" action="{{ route('updateBeca', $beca['id']) }}" id="formBeca" class="mt-3 row">
        @csrf
        <h2 class="form-title">Beca</h2>
        
        <div class="form-group mb-3 col-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="{{$beca['nombre']}}">
        </div>

        <div class="form-group mb-3 col-6">
            <label class="form-label" for="descuento">% Descuento</label>
            <input class="form-control" type="number" id="descuento" name="descuento" value="{{$beca['descuento']}}" min="0" max="100">
        </div>

        <div class="form-group mb-3 col-12">
            <label class="form-label" for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{$beca['descripcion']}}</textarea>
        </div>

        <div class="buttons mb-3">
            <button type="submit" id="btn-enviar" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection