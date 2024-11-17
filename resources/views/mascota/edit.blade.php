@extends('layout.app')

@section('title', 'Registrando Mascota')

@section('content')
    <div class="main-container">
        <div class="hero bg-base-200 min-h-48">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold">Registrar Mascota N°{{ $mascota->id }}</h1>
                    <a class="btn btn-primary mt-5 min-h-max h-max py-2" href="{{ route('mascotas.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>

        <div class="form-container flex justify-center py-12">
            <form action="{{ route('mascotas.update', $mascota->id) }}" class="flex flex-col justify-center items-center" method="POST">
                @csrf
                @method('PUT')

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

                <div class="grid grid-cols-2 grid-rows-2 gap-4 items-center">
                    <div class="row px-5">
                        <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow" id="nombre" name="nombre" placeholder="Nombre" value="{{ $mascota->nombre }}" />
                    </div>
                    <div class="row px-5">
                        <select name="especie_id" id="especie_id" class="select select-bordered w-full max-w-xs">
                            @foreach ($especieList as $especie)
                                <option value="{{ $especie->id }}" {{ $especie->id == $especie->especie_id ? 'selected' : ''  }}>{{ $especie->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row px-5">
                        <select name="genero" id="genero" class="select select-bordered w-full max-w-xs">
                            @foreach ($generoList as $genero)
                                <option value="{{ $genero->id }}" {{ $genero->id == $especie->genero ? 'selected' : ''  }}>{{ $genero->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row px-5">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Fecha Nacimiento</span>
                            </div>
                            <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="input input-bordered w-full max-w-xs" value="{{ $mascota->fecha_nacimiento }}" />
                        </label>
                    </div>
                </div>

                <button class="btn btn-wide btn-primary min-h-max h-max py-2  my-5" type="submit"><i class="fa-solid fa-floppy-disk"></i></i> Guardar</button>

            </form>
        </div>
    </div>
@endsection
