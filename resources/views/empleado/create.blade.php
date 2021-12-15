@extends('layouts.app')
@section('content')
<div class="container">
    
    {{-- enctype nos permite mandar fotos --}}
    <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
        @csrf {{-- safety key --}}
        @include('empleado.form',['modo'=>'Crear', 'data'=>'empleado'])
    </form>
    
</div>
@endsection