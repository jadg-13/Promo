@extends('templates.templateadmin')

@section('content')
<h1>Usuarios</h1>
<a href="{{route('admin.user.add')}}" class="btn btn-outline-success">Nuevo Registro</a>
<form action="{{ route('admin.user.show') }}" method="GET" class="mb-4">
    <div class="form-row">
        <div class="col-md-6 mb-4">
            <label for="filter">Filtro</label>
            <input type="text" name="filter" id="filter" class="form-control" value="{{ request('filter') }}">
        </div>
        <div class="col-md-6 mb-4">
            <div class="row">
                <button type="submit" class="btn btn-outline-primary col-12 col-md-6">Filtrar</button>
                <a href="{{ route('exportuser', ['filtro' => Request::get('filter')]) }}" class="btn btn-outline-success col-12 col-md-6">Exportar</a>
            </div>   
        </div>
    </div>
</form>

    <table class="table table-striped">
        <thead>
            <tr>
                <td>Email</td>
                <td>Código</td>
                <td>Rol</td>
                <td>Fecha de Verificacion</td>
            </tr>
        </thead>
        <tbody>
                @foreach ($datos as $item)
                <tr>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->code_mail }}</td>
                    <td>{{ $item->rol }}</td>
                    <td>{{ $item->email_verified_at }}</td>
                </tr>
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection
