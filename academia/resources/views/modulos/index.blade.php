@extends('plantillas.plantilla')
@section("titulo")
Academia s.a.
@endsection
@section("cabecera")
Gestion Modulos
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))
    <p class="alert alert-info my-3">{{$text}}</p>
@endif
<a href="{{route('modulos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear modulo</a>
<form action="{{route('modulos.index')}}" name="search" method="get" class="form-inline float-right">
  <input type="text" placeholder="Buscar por nombre" name="nombre">
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
 <table class="table table-striped table-dark text-center">
  <thead>
    <tr>
      <th scope="col">Detalles</th>
      <th scope="col" class="align-middle">Nombre</th>
      <th scope="col" class="align-middle">Horas/Semana</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($modulos as $modulo)
        <tr>
            <th scope="row align-middle">
              <a href="{{route('modulos.show', $modulo)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$modulo->nombre}}</td>
            <td class="align-middle">{{$modulo->horas}}</td>
            <td class="align-middle" style="white-space: nowrap">
                <form action="{{route('modulos.destroy', $modulo)}}" name="del" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" onclick="return confirm('¿Borrar Modulo?')" class="btn btn-danger fa fa-trash" ></button>
                    <a href="{{route('modulos.edit', $modulo)}}" class="ml-2 fa fa-edit btn btn-warning "></a>
                </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$modulos->appends(Request::except("page"))->links()}}
@endsection