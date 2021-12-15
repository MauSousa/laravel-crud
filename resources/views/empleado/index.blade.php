@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>  
    </div>
@endif

<a href="{{ url('/empleado/create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            
        <tr>
            <td>{{ $empleado->id }} </td>
            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" alt="user photo" width="180" height="180">
            </td>
            <td>{{ $empleado->Nombre }} </td>
            <td>{{ $empleado->ApellidoPaterno }} </td>
            <td>{{ $empleado->ApellidoMaterno }} </td>
            <td>{{ $empleado->Correo }} </td>
            <td>
                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">Editar</a>

                <form action="{{ url('/empleado/'.$empleado->id ) }}" method="post" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">
                    
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="position-absolute top-50 start-50 translate-middle">
    {!! $empleados->links() !!}
</div>
</div>
@endsection