@extends('templates.template')
@section('content')

<h1>Confirmar Código de Seguridad</h1>

<p>Por favor, ingresa el código de seguridad enviado a tu correo electrónico:</p>

<form method="POST" action="{{ route('validatecode') }}">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <input type="hidden" name="id" value="{{ $customer->id }}">
            <input type="text" name="codigo" class="form-control" required>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
        </div>
    </div>
    
</form>   
@endsection