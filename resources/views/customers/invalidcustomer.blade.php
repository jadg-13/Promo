@extends('templates.template')
@section('content')
    <h1>Usuario no registrado</h1>
    <p>Verifique sus datos y vuelva a intentar...</p>
    <a href="{{ route('customer.index') }}">Registrarse</a>
@endsection
