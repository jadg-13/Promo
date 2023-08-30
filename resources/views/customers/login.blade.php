@extends('templates.template')
@section('content')
    <div class="container py-5 h-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-5 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                        style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Bienvenido</h4>
                                </div>

                                <form method="POST" class="login" action="{{ route('customer.login') }}">
                                    @csrf
                                    <br>
                                    <div class="form-outline mb-5">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="example@example.com">
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <button type="submit" class="btn btn-outline-primary">Iniciar sesión</button>
                                    </div>
                                </form>

                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p>No estoy registrado - <a href="{{ route('customer.add') }}">Registrarme</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class=" px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Iniciar Sesión</h4>
                                <p class="small mb-0">Para acceder a tu sesión escribe tu correo electronico, presiona Iniciar Sesión; a continuación, revisa tu email y escribe
                                    el código que se te ha enviado.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
