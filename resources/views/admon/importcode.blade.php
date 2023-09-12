@extends('templates.templateadmin')

@section('content')
    <form action="{{ route('importxls') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo">
        <button type="submit">Importar</button>
    </form>
@endsection
