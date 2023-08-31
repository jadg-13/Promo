@extends('templates.template')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card" style="width: 32rem;">

            <div class="row">
                <form method="POST" action="{{ route('customer.register') }}">
                    @csrf
                    <h1>Registrar </h1>
                    <div class="form-group p-md-4">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="tucorreo@example.com" class="form-control" {{ old('email') }}
                            required>
                        @error('email')
                            <small>{{ $message }}</small>
                            <br>
                        @enderror
                    </div>

                    <div class="form-group p-md-3">
                        <button type="submit" class="btn btn-outline-success col-12">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
