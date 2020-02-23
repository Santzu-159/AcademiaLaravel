@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Gestion Modulos
@endsection
@section("contenido")
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card bg-primary">
    <div class="card-header text-center">Guardar modulo</div>
    <div class="card-body">
        <form action="{{route('modulos.store')}}" name="g" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required id="nom">
                </div>
                <div class="col">
                    <label for="ho" class="col-form-label">Horas</label>
                    <input type="number" name="horas" class="form-control" placeholder="Horas" required id="ho" min="0" max="8">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <input type="submit" value="Crear" class="btn btn-success">
                    <input type="reset" value="limpiar" class="btn btn-warning">
                    <a href="{{route('modulos.index')}}" class="btn btn-info">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection