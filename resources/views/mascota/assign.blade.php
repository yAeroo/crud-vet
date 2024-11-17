@extends('layout.app')

@section('title', 'Registrando Mascota')

@section('content')
    <div class="main-container">
        <div class="hero bg-base-200 min-h-48">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold">Asignar Propietario a Mascota N°{{$mascota->id}}</h1>
                    <a class="btn btn-primary mt-5 min-h-max h-max py-2" href="{{ route('mascotas.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>

        <div class="form-container flex justify-center py-12">
            <form action="{{ route('propietarios.store', $mascota->id) }}" class="flex flex-col justify-center items-center" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 my-2 rounded relative" role="alert">
                        <strong class="font-bold">¡Oops! Ha ocurrido un error</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-2 grid-rows-3 gap-4 items-center">
                    <div class="row px-5">
                        <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow" id="nombre" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" />
                    </div>
                    <div class="row px-5">
                        <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow" id="apellido" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" />
                    </div>
                    <div class="row px-5">
                        <label class="form-control w-full max-w-xs">
                            <input name="telefono" id="telefono" type="number" placeholder="Teléfono" class="input input-bordered w-full max-w-xs" value="{{ old('telefono') }}" />
                        </label>
                    </div>
                    <div class="row px-5">
                        <label class="form-control w-full max-w-xs">
                            <input name="dui" id="dui" type="text" placeholder="DUI" class="input input-bordered w-full max-w-xs" value="{{ old('fecha_nacimiento') }}" />
                        </label>
                    </div>
                    <div class="row px-5">
                        <select name="genero" id="genero" class="select select-bordered w-full max-w-xs">
                            <option value="" hidden selected disable> Selecciona un Género...</option>
                            @foreach ($generoList as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn btn-wide btn-primary min-h-max h-max py-2  my-5" type="submit"><i class="fa-solid fa-floppy-disk"></i></i> Registrar</button>

            </form>
        </div>
    </div>
@endsection
