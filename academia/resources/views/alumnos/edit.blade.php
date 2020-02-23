@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Editar Alumno
@endsection
@section("contenido")
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card bg-info border border-dark">
    <div class="card-header text-center text-white font-weight-bold"><h1>Editar Alumno</h1></div>
    <div class="card-body">
        <div class="float-right">
            <img src="{{asset($alumno->logo)}}" width="120px" height="120px" class="rounded-circle">
        </div>
    <form name="g" action="{{route('alumnos.update',$alumno)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-row">
            <div class="col">
                <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$alumno->nombre}}" id="nom" required>
            </div>
            <div class="col">
                <label for="ape" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="{{$alumno->apellidos}}" id="ape" required>
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <label for="mail" class="col-form-label">E-Mail</label>
                <input type="mail" class="form-control" name="mail" value="{{$alumno->mail}}" id="mail" required>
            </div>
            <div class="col">
                <label for="logo" class="col-form-label">Logo</label>
                <input type="file" class="form-control p-1" name="logo" id="logo" accept="image/*">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <input type="submit" value="Editar" class="btn btn-success">
            <a href="{{route('alumnos.index')}}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection