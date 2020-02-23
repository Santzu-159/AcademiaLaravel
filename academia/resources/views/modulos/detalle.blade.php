@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Detalle Modulo
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))

    <p class="alert alert-info my-3">{{$text}}</p>
    
@endif
<span class="cleafix"></span>
<div class="card text-white bg-info mt-4 mx-auto" style="max-width:48rem;">
    <div class="card-header text-center"><b>{{($modulo->nombre)}}</b></div>
    <div class="card-body" style="font-size:1.1em;">
        <p class="card-text">
        <p><b>Nombre:</b> {{$modulo->nombre}}</p>
        <p><b>Horas/Semana:</b> {{$modulo->horas}}</p>
        </p>
        <a href="{{route('modulos.index')}}" class="float-right btn btn-success mt-3">Volver</a>
    </div>
</div>
@endsection