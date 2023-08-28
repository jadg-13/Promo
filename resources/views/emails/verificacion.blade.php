@extends('templates.template')
@section('content')
<h1>Verificación de correo electrónico</h1>

    <p>Por favor, ingresa el siguiente código de verificación para activar tu cuenta:</p>

    <h2>{{ $codigoVerificacion }}</h2>
@endsection
