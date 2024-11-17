@extends('layout.app')

@section('title', 'Mascotas Listado')

@section('content')
    <div class="main-container">
        <div class="hero bg-base-200 min-h-48">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold">Mascota Listado</h1>
                    <a class="btn btn-primary mt-5 min-h-max h-max py-2" href="{{ route('mascotas.create') }}">
                        <i class="fa-solid fa-plus"></i>
                        Agregar Mascota
                    </a>
                </div>
            </div>
        </div>

        @if (session('success')) <!-- Checking if the Success Session is Set -->
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 mt-12 shadow-md mx-40" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">¡Éxito!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="table-container px-20 mx-20 py-5 my-10">
            <div class="overflow-x-auto min-h-screen">
                <table class="table table-fixed h-full overflow-visible">
                    <thead class="text-center"> <!-- Encabezado -->
                        <tr class="text-sm bg-lime-200">
                            <th class="w-20">#</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Fecha Nacimiento</th>
                            <th class="w-48">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"> <!-- Cuerpo y Mapeo -->
                        @if ($mascotasList->isEmpty()) <!-- Verificando si esta vacío -->
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fa-regular fa-folder-open mr-1"></i>
                                    No se encontraron mascotas
                                </td>
                            </tr>
                        @else
                            {{ $i = 0; }} <!-- Iniciando el contador -->
                            @foreach ($mascotasList as $mascota) <!-- Mapeo de Mascotas -->
                            <tr>
                                <th class="py-5">{{ ++$i }}</th>
                                <td>{{ $mascota->nombre }}</td>
                                <td>{{ $mascota->especie->nombre }}</td>
                                <td>{{ $mascota->fecha_nacimiento }}</td>
                                <td>
                                    <div class="dropdown">
                                        <div tabindex="0" role="button" class="btn min-h-max h-max py-2 bg-sky-300 hover:bg-sky-400 border-sky-300">
                                            <i class="fa-solid fa-gear"></i>
                                            Acciones
                                        </div>
                                        <ul tabindex="1" class="dropdown-content menu bg-base-100 rounded-box z-10 p-2 shadow absolute">
                                            <li><a id="{{ $mascota->id }}" class="detailsToggle">
                                                <i class="fa-solid fa-binoculars"></i>
                                                Detalles
                                            </a></li>
                                            <li><a href="{{ route('mascotas.edit', $mascota->id) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Editar
                                            </a></li>
                                            <li><a href="{{ route('mascotas.assign', $mascota->id) }}">
                                                <i class="fa-solid fa-bookmark"></i>
                                                Asignar Propietario
                                            </a></li>
                                            <li>
                                                <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="detailsModal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-lg"> {{-- Modal - Título e Ícono --}}
                <i class="fa-solid fa-magnifying-glass mx-2"></i>
                Detalles de la Mascota
            </h3>
            <div class="modal-body py-2"> {{-- Modal - Contenido --}}
                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Nombre:</h1>
                        <p id="detailsNombre">Nombre</p>
                    </div>

                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Especie:</h1>
                        <p id="detailsEspecie">Especie</p>
                    </div>

                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Género:</h1>
                        <p id="detailsGenero">Género</p>
                    </div>

                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Fecha Nacimiento:</h1>
                        <p id="detailsFechaNac">FechaNac</p>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-lg mt-2">
                <i class="fa-solid fa-magnifying-glass mx-2"></i>
                Detalles de Propietario
            </h3>
            <div class="modal-body py-2">
                <div class="grid grid-cols-2 grid-rows-2 gap-4">
                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Nombre:</h1>
                        <p id="detailsNombreProp">Nombre</p>
                    </div>

                    <div class="row px-5">
                        <h1 class="text-lg font-bold">Teléfono:</h1>
                        <p id="detailsTelefonoProp">Teléfono</p>
                    </div>

                    <div class="row px-5">
                        <h1 class="text-lg font-bold">DUI:</h1>
                        <p id="detailsDUIProp">DUI</p>
                    </div>
                </div>
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-primary" onclick="detailsModal.closeModal()">Cerrar</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        $(document).ready(function() {
            $('.detailsToggle').click(function() {
                $.ajax({
                    url: '/mascotas/' + $(this).attr('id'),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#detailsNombre').text(response.nombre);
                        $('#detailsEspecie').text(response.especie.nombre);
                        $('#detailsGenero').text(response.genero.nombre);
                        $('#detailsFechaNac').text(response.fecha_nacimiento);

                        if (response.propietario == null) {
                            $('#detailsNombreProp').text('No asignado');
                            $('#detailsTelefonoProp').text('No asignado');
                            $('#detailsDUIProp').text('No asignado');
                        }else{
                            $('#detailsNombreProp').text(response.propietario.nombre);
                            $('#detailsTelefonoProp').text(response.propietario.telefono);
                            $('#detailsDUIProp').text(response.propietario.dui);
                        }
                        detailsModal.showModal();
                    }
                });
            });
        });
    </script>
@endsection
