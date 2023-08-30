@extends('templates.templateadmin')

@section('content')
<h1>Registrar Usuario Administrador</h1>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="col-12 col-md-4">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" {{old('email')}} required>
        
    </div>

    <div class="col-12 col-md-4">
        <button type="submit" class="btn btn-outline-success col-12">Registrar</button>
    </div>
</form>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('error_message'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Verifique:',
            text: '{{ session('error_message') }}'
        });
    </script>
@endif

@if(session('success_message'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('success_message')}}',
  showConfirmButton: false,
  timer: 1000
})
</script>
@endif
@endsection