@extends('layouts.app')

@section('content')
    <form class="form" action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
        {{-- llave de seguridad que se necesita en laravel para saber si se envia del mismo sistema --}}
        @csrf
        @include('empleado.form', ['modo' => 'Crear'])
    </form>
@endsection
