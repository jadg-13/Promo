@extends('templates.templateadmin')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">
        <div class="card" style="width: 32rem;">
            <form method="POST" action="{{ route('admin.codes.store') }}">
                @csrf
                <div class="form-group p-md-4">
                    <label for="code">Código:</label>
                    <input type="text" name="code" id="code" class="form-control">
                </div>

                <div class="form-group p-md-4 text-center">
                    <button type="submit" class="btn btn-outline-success col-12 col-md-4">Guardar</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('message'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Eliminar la sesión enviada
                    @php
                        session()->forget('message');
                    @endphp
                }
            });
        </script>
    @endif
    @if (session('error_message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error:',
                text: '{{ session('error_message') }}'
            });
        </script>
    @endif
@endsection
