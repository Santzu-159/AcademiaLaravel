@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Editar Modulo
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
    <div class="card-header text-center">Editar Modulo
    </div>
    <div class="card-body">
        <form action="{{route('modulos.update',$modulo)}}" name="g" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value='{{$modulo->nombre}}' required id="nom">
                </div>
                <div class="col">
                    <label for="ho" class="col-form-label">Horas</label>
                    <input type="text" name="horas" class="form-control" value='{{$modulo->horas}}' required id="ho">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <input type="submit" value="Editar" class="btn btn-success">
                    <a href="{{route('modulos.index')}}" class="btn btn-info">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection