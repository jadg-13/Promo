@extends('templates.template')
@section('content')
    <h1>Confirmar Código de Seguridad</h1>

    <p>Por favor, ingresa el código de seguridad enviado a tu correo electrónico:</p>

    <form method="POST" action="{{ route('validatecode') }}" class="frm">
        @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <input type="text" name="codigo" id="codigo" class="form-control">

                <button type="submit" class="btn btn-outline-primary">Confirmar</button>
            </div>
        </div>


    </form>
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
