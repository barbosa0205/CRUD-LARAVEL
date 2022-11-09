<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .flex {
            display: flex;
        }

        img {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        @if (Session::has('mensaje'))
            <div class="alert alert-primary alert-dismissible fade show mt-3">
                {{ Session::get('mensaje') }}

                {{-- Close alert button --}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <main>
            <a class="btn btn-dark mt-4" href="{{ url('empleado/create') }}">Registrar nuevo empleado</a>
            <div class="table-responsive">


                <table class="table table-dark table-bordered table-striped table-sm table-hover mt-4 ">

                    <thead class="thead-light">
                        <tr>
                            <th>Posición</th>
                            <th>Fotografia</th>
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
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center"><img
                                            src="{{ isset($empleado->Foto) ? asset('storage') . '/' . $empleado->Foto : '' }}"
                                            alt="empleado profile" />
                                    </div>
                                </td>
                                <td class="align-middle">{{ $empleado->Nombre }}</td>
                                <td class="align-middle">{{ $empleado->ApellidoPaterno }}</td>
                                <td class="align-middle">{{ $empleado->ApellidoMaterno }}</td>
                                <td class="align-middle">{{ $empleado->Correo }}</td>
                                <td>
                                    <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}"><button
                                            class="btn btn-warning my-1">Editar</button></a>
                                    <form action="{{ url('/empleado/' . $empleado->id) }}" method="post">
                                        @csrf
                                        {{-- metodo DELETE --}}
                                        {{ method_field('DELETE') }}

                                        <input class="btn btn-danger mb-1" type="submit" value="Borrar"
                                            onclick="return confirm('¿Quieres Borrar?')">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $empleados->links() !!}
            </div>
        </main>
    @endsection
</body>

</html>
