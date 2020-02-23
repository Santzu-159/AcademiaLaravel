@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Modulos Disponibles para el alumno {{$alumno->nombre.", ".$alumno->apellidos}}
@endsection
@section("contenido")
<form name="matriculas" method="POST" action="{{route('alumnos.matricular')}}">
    @csrf
    <input type="hidden" name="alumno_id" value="{{$alumno->id}}">
    <div class="form-row">
        <select name="modulo_id[]" class="form-control" multiple>
            @foreach ($modulos2 as $modulo)
                <option value="{{$modulo->id}}">{{$modulo->nombre." (".$modulo->horas.")"}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row mt-3">
        <div class="col">
            <input type="submit" value="Matricular" class="btn btn-info mr-3">
            <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</form>
@endsection