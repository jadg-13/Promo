@extends('templates.template')
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card" style="width: 32rem;">


            <form method="POST" action="{{ route('validatecode') }}" class="frm">
                @csrf
                <h1 class="h2 text-center">Confirmar Código de Seguridad</h1>

                <p class ="container">Por favor, ingresa el código de seguridad enviado a tu correo electrónico:</p>
                <div class="form-group p-md-4">
                    <div class="col-12">
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <input type="text" name="codigo" id="codigo" class="form-control">
                    </div>
                    <div class="form-group p-md-3">
                        <button type="submit" class="btn btn-outline-primary col-12">Confirmar</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.frm').submit(function(e) {

            var codeInput = document.getElementById('codigo');
            var code = codeInput.value.trim();
            if (code === '') {
                e.preventDefault();
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Revisa tu email y escribe el código de verificación',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    </script>
    @if (session('error_message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error al validar',
                text: '{{ session('error_message') }}'
            });
        </script>
    @endif
@endsection
