@extends('templates.templateadmin')

@section('content')
    <h1>Códigos</h1>
    <div class="row mb-3 ">
        <div class="col-md-6">
            <a href="{{ route('admin.codes.add') }}" class="btn btn-outline-success">Nuevo Registro</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('admin.codes.importxls') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="excel_file">
                <button type="submit" class="btn btn-outline-primary">Importar</button>
            </form>
        </div>
    </div>
    <form action="{{ route('admin.codes.findby') }}" method="GET" class="mb-4">
        <div class="row  ">
            <div class="col-auto">
                <label for="filter">Filtro</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="filter" id="filter" class="form-control" value="{{ request('filter') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-primary col-12 col-md-6">Filtrar</button>
            </div>
        </div>


    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Estado</th>
                <th>Fecha de Verificaciónn</th>
                <th>Fecha de Creación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td>{{ $dato->id }}</td>
                    <td>{{ $dato->code }}</td>
                    <td>{{ $dato->asset }}</td>
                    <td>{{ $dato->verified_at }}</td>
                    <td>{{ $dato->created_at }}</td>
                    <td>
                        <form action="{{ route('admin.codes.delete', $dato->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger col-12">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('message'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Eliminar la sesión enviada
                    @php
                        session()->forget('message');
                    @endphp
                }
            });
        </script>
    @endif
    @if (session('error_message'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error:',
            text: '{{ session('error_message') }}'
        });
    </script>
@endif
@endsection
