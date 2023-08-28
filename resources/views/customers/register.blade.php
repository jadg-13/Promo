@extends('templates.template')

@section('content')
    <h1>Register</h1>
    <form method="POST" action="{{ route('customer.register') }}">
        @csrf
        <div class="col-12 col-md-4">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" {{old('email')}} required>
            @error('email')
                <small>{{ $message }}</small>
                <br>
            @enderror
        </div>

        <div class="col-12 col-md-4">
            <button type="submit" class="btn btn-outline-success col-12">Registrar</button>
        </div>
    </form>
    
@endsection
