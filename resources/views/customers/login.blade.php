@extends('templates.template')
@section('content')
    <div class="tab-content ">
        <div class="tab-pane fade show active col-12 col-md-4" id="pills-login" role="tabpanel" aria-labelledby="tab-login">

            <form method="POST" class="login" action="{{ route('customer.login') }}">
                @csrf
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">

                </div>
                <br>

                <br>
                <div class="form-group col-12 text-center">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </form>
            <br>
            <div class="text-center">
                <p>No estoy registrado - <a href="{{ route('customer.add') }}">Registrarme</a></p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.login').submit(function(e) {
           
            var emailInput = document.getElementById('email');
            var email = emailInput.value.trim();
            if (email === '') {
                e.preventDefault();
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Escriba su email...',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    </script>
@endsection
