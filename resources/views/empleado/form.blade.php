<h1>{{$modo}} empleado</h1>

@if( count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger border-0 fs-5">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="form-group">

    <label for="name">Nombre</label>
    <input type="text" class="form-control my-2" name="Nombre" value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre')}}" id="name" required>

    <label for="lastName">Apellido Paterno</label>
    <input type="text" class="form-control my-2" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('ApellidoPaterno')}}" id="lastName" required>
    
    <label for="secondLastName">Apellido Materno</label>
    <input type="text" class="form-control my-2" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno')}}" id="secondLastName" required>
    
    <label for="mail">Correo</label>
    <input type="email" class="form-control my-2" name="Correo" value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo')}}" id="mail" required>
     
    <label for="photo"></label>
    @if(isset($empleado->Foto))
    <img src="{{ asset('storage').'/'.$empleado->Foto }}" alt="user photo" class="img-thumbnail img-fluid my-2" width="180" height="180"> 
    {{-- width="200" height="200" --}}
    @endif
    <input type="file" class="form-control mb-3" name="Foto" value="" id="photo">
</div>

<input type="submit" class="btn btn-success" value="{{ $modo }} {{ $data }}">
<a href="{{ url('/empleado')}}" class="btn btn-primary">Regresar</a>




