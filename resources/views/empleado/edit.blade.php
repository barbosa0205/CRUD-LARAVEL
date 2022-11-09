@extends('layouts.app')

@section('content')
    <form class="form" action="{{ url('/empleado/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
        {{-- llave de seguridad que se necesita en laravel para saber si se envia del mismo sistema --}}
        @csrf
        {{ method_field('PATCH') }}

        @include('empleado.form', ['modo' => 'Editar'])

    </form>
@endsection
