@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH')}}

{{-- El arreglo manda datos personalizados --}}
@include('empleado.form', ['modo'=>'Editar', 'data'=>'empleado'])

</form>
</div>
@endsection