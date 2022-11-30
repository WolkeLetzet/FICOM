@extends('layouts.app')

@section('content')
@if ($errors->any())
   @foreach ( $errors->all() as $error )
      <div class="alert alert-danger">{{$error}}</div>
   @endforeach
@endif

@if (session('success'))
   <div class="alert alert-success">{{session('success')}}</div>
@endif


   

      <form action="{{ route('subirReg') }}" method="POST" enctype="multipart/form-data">
         
         @csrf
         <div class="container" id="registros-container" style="background-color: white; height: 500px;">
            <div class="row p-2 pt-5">
               <div class="col">
                  <div class="mb-3">
                     <label for="subirArchivo" class="form-label">Tipo de Registro que se subira</label>
                     <select class="form-select" name="tipoRegistro" id="tipoRegistro">
                        <option value="prioritarios">Lista de Alumnos Prioritarios (XLSX)</option>
                        <option value="nomina">Lista de Alumnos (XML)</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row p-2 pt-5">
               <div class="col">
                  <div class="mb-3">
                     <label for="subirArchivo" class="form-label">Archivo de Registros</label>
                     <input class="form-control" type="file" id="subirArchivo" name="file">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div>
                     <button class="btn btn-primary" type="submit" name="submit">Enviar</button></form>
                  </div>
               </div>
            </div>
         </div>
      </form>
   <style lang="scss">
      div#registros-container{
         -webkit-box-shadow: 30px 14px 47px -8px rgba(97,113,194,1);
         -moz-box-shadow: 30px 14px 47px -8px rgba(97,113,194,1);
         box-shadow: 30px 14px 47px -8px rgba(97,113,194,1);
      }
   </style>
@endsection
