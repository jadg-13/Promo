@extends('templates.templateadmin')

@section('content')
    <div class="embed-responsive embed-responsive-16by9">
        <h1>Clientes</h1>
        
        <form action="{{ route('customer.findby') }}" method="GET" class="mb-4">
            <div class="form-row">
                <div class="col-md-6 mb-4">
                    <label for="filter">Filtro</label>
                    <input type="text" name="filter" id="filter" class="form-control" value="{{ request('filter') }}">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <button type="submit" class="btn btn-outline-primary col-12 col-md-6">Filtrar</button>
                        <a href="{{ route('export', ['filtro' => Request::get('filter')]) }}" class="btn btn-outline-success col-12 col-md-6">Exportar</a>
                    </div>
                    
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Identificación</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Número de factura</th>
                    <th>Código Asignado</th>
                    <th>Punto de venta</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->second_name }}</td>
                        <td>{{ $user->identification }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->invoice_number }}</td>
                        <td>{{ $user->code }}</td>
                        <td>{{ $user->point_sale }}</td>
                        <td>@if($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Imagen del cliente" width="180px" height="100px">
                        @else
                            Sin imagen
                        @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
@endsection
