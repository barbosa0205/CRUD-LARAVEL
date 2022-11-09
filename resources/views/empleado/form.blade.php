<head>
    <link rel="stylesheet" href="/css/empleado/create.css">

    <style>
        .empleadoImageForm {
            border-radius: 50%;
            width: 8rem;
            height: 8rem;
            object-fit: cover;
        }
    </style>
</head>
<h1>{{ $modo }} empleado</h1>

<div class="form-group d-flex flex-column align-items-center">
    <label class="form-label d-block t" for="foto">
        Foto</label>
    @if (isset($empleado->Foto))
        <img class="empleadoImageForm mb-3" src="{{ asset('storage') . '/' . $empleado->Foto }}" alt="empleado"
            width="100">
    @endif
    <input class="form-control" type="file" value="" name="foto" id="foto">
</div>

<div class="form-group">
    <label class="form-label" for="nombre">Nombre</label>

    {{-- old() mantiene los datos de los inputs si hay errores  --}}
    <input class="form-control" type="text"
        value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('nombre') }}" name="nombre" id="nombre">

</div>

<div class="form-group">
    <label class="form-label" for="apellidoPaterno">Apellodo Paterno</label>
    <input class="form-control" type="text"
        value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('apellidoPaterno') }}"
        name="apellidoPaterno" id="apellidoPaterno">
</div>

<div class="form-group">
    <label class="form-label" for="ApellidoMaterno">Apellodo Materno</label>
    <input class="form-control" type="text"
        value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno') }}"
        name="ApellidoMaterno" id="ApellidoMaterno">
</div>

<div class="form-group">
    <label class="form-label" for="correo">Correo</label>
    <input class="form-control" type="email"
        value="{{ isset($empleado->Correo) ? $empleado->Correo : old('correo') }}" name="correo" id="correo">
</div>
<div class="form-group  mt-3">

    <button class="btn btn-success" type="submit">{{ $modo }} datos</button>
    <a class="btn btn-primary link" href="{{ url('/') }}">Regresar</a>
</div>

@if (count($errors) > 0)

    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
