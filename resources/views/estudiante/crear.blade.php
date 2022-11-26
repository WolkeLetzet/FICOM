@extends('layouts.app')
@section('content')
<div class="container">
    <form id="crearEstudiante" class="col-md-10 mt-3 row" onsubmit="crearEstudiante(event)">
        <h1>Estudiante</h1>
        <div class="form-group mb-3 col-3">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" autofocus>
        </div>
        <div class="form-group mb-3 col-3">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" class="form-control">
        </div>
        <div class="form-group mb-3 col-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="run" class="form-label">RUN</label>
            <input type="text" id="run" name="run" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="nivel" class="form-label">Nivel</label>
            <input type="text" id="nivel" name="nivel" class="form-control">
        </div>
        <div class="form-group mb-3 col-4">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select id="prioridad" name="prioridad" class="form-control">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="Sin Beneficios">Sin Beneficios</option>
                <option value="Nuevo Prioritario">Nuevo Prioritario</option>
                <option value="Prioritario">Proritario</option>
            </select>
        </div>
        <div class="row">
            <h1>Apoderado</h1>
            <div class="form-group mb-3 col-6">
                <label for="fullname" class="form-label">Nombre completo</label>
                <input type="text" id="fullname" name="fullname" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
<script>
    function crearEstudiante(event) {
        event.preventDefault();

        let data = {
            apellidos: document.getElementById('apellido_paterno').value + ' ' + document.getElementById('apellido_materno').value,
            nombres: document.getElementById('nombres').value,
            run: document.getElementById('run').value,
            nivel: document.getElementById('nivel').value,
            prioridad: document.getElementById('prioridad').value,
        }

        axios.post('/api/estudiante/crear', data).then(res => {
            console.log(res);
            document.getElementById('crearEstudiante').reset();
        }, err => {
            console.log(err);
        }) 
    }
</script>
@endsection
