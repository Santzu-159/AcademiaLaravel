@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Detalle Alumno
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))

    <p class="alert alert-info my-3">{{$text}}</p>
    
@endif
<span class="cleafix"></span>
<div class="card text-white bg-info mt-4 mx-auto" style="max-width:48rem;">
    <div class="card-header text-center"><b>{{($alumno->nombre)}}</b></div>
    <div class="card-body" style="font-size:1.1em;">
        <h5 class="card-title text-center">{{$alumno->id}}</h5>
        <p class="card-text">
        <div class="float-right"><img src="{{asset($alumno->logo)}}" width="160px" height="160px" alt=""></div>
        <p><b>Nombre:</b> {{$alumno->nombre.", ".$alumno->apellido}}</p>
        <p><b>Mail:</b> {{$alumno->mail}}</p>
        <p><b>Modulos:</b>
            <ul>
                @foreach ($alumno->modulos as $item)
                    <li>{{$item->nombre. " (".$item->pivot->nota.")"}}</li>
                @endforeach
            </ul>
        </p>
        <p class="card-text">
            <b>Nota Media:</b>
            @if ($alumno->notaMedia()!='Sin Nota' && $alumno->notaMedia()<5)
                <span class='text-dark bg-danger'>{{$alumno->notaMedia()}}</span>
            @else
                <span class='text-dark bg-success'>{{$alumno->notaMedia()}}</span>
            @endif
        </p>
        </p>
        <a href="{{route('alumnos.index')}}" class="float-right btn btn-success mt-3">Volver</a>
        <a href="{{route('alumnos.fmatricula', $alumno)}}" class="float-right btn btn-warning mr-2 mt-3" >Matricular Alumno</a>
        <a href="{{route('alumnos.fcalificar', $alumno)}}" class="float-right btn btn-danger mr-2 mt-3" >Calificar Alumno</a>
    </div>
</div>
@endsection