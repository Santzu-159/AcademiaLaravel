@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Gestion Alumnos
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))
    <p class="alert alert-success my-3">{{$text}}</p>
@endif
<a href="{{route('alumnos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear alumno</a>
<form action="{{route('alumnos.index')}}" name="search" method="get" class="form-inline float-right">
  <select name="modulos" class="form-control">
    <option value="%">Filtrar por Modulo
    </option>
    @foreach ($modulos as $modulo)
      @if ($request->modulos == $modulo->id)
        <option value="{{$modulo->id}}" selected>{{$modulo->nombre}}</option>
      @else
        <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
      @endif
    @endforeach
  </select>
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
 <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Detalles</th>
      <th scope="col" class="align-middle">Nombre</th>
      <th scope="col" class="align-middle">Mial</th>
      <th scope="col" class="align-middle">Imagen</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($alumnos as $alumno)
        <tr>
            <th scope="row align-middle">
                <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$alumno->apellidos.", ".$alumno->nombre}}</td>
            <td class="align-middle">{{$alumno->mail}}</td>
            <td class="align-middle">
                <img src="{{asset($alumno->logo)}}" width="80px" height="80px" class="img-fluid rounded-circle" alt="">
            </td>
            <td class="align-middle" style="white-space: nowrap;">
            <form class="form-inline" name='del' action='{{route('alumnos.destroy', $alumno)}}' method='POST'>
              @method("DELETE")
              @csrf
              <button type="submit" onclick="return confirm('¿Borrar alumno?')" class="btn btn-danger fa fa-trash fa-1x"></button>
              <a href="{{route('alumnos.edit',$alumno)}}" class="ml-2 fa fa-edit fa-1x btn btn-warning"></a>
            </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$alumnos->appends(Request::except("page"))->links()}}
@endsection