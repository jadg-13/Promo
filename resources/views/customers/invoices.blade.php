@extends('templates.template')
@section('content')
    <div class="card col-12 col-md-6">
        <div class="card-header">
            <h2>Cliente</h2>
            <a href="{{ route('customer.logout') }}">Salir</a>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.invoices.save') }}" method="POST" enctype="multipart/form-data" class="frm">
                @csrf

                <div class="row">
                    <div class="col-3 col-md-4 text-center">
                        <p class="">Identificado:</p>
                    </div>
                    <div class="col-9 col-md-8 ">
                        <p class="h4" id="email"><?php echo $customer->email; ?></p>
                    </div>

                </div>

                <h5>Ingresar Nueva Factura</h5>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="firstname">Nombres</label>
                        <input type="text" name="firstname" id="firstname" class="form-control"
                            value="{{ old('firstname') }}" required>
                        @error('firstname')
                            <small>{{ $message }}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="secondname">Apellidos</label>
                        <input type="text" name="secondname" id="secondname" class="form-control"
                            value="{{ old('secondname') }}" required>
                        @error('secondname')
                            <small>{{ $message }}</small>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="identification">Identificación</label>
                        <input type="text" name="identification" id="identification" class="form-control"
                            value="{{ old('identification') }}" required>

                        @error('identification')
                            <small>{{ $message }}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value=" {{ old('phone') }}" required>
                        @error('phone')
                            <small>{{ $message }}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <label for="num_fact">Número de Factura</label>
                            <input type="text" id="num_fact" name="num_fact" class="form-control"
                                value="{{ old('num_fact') }}" required>
                    
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="codigo_fact">Codigo a verificar</label>
                            <input type="text" id="codigo_fact" name="codigo_fact" class="form-control"
                                value="{{ old('codigo_fact') }}" required>
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12  ">
                            <br>
                            <label for="num_fact">Punto de venta</label>
                            <select id="punto_venta" name="punto_venta" class="form-control" required>
                                <option disabled selected value="">Seleccionar</option>
                                <option value="Pali">Pali</option>
                                <option value="Colonia">Colonia</option>
                                <option value="Oriental">Oriental</option>
                            </select>

                            <script>
                                var puntoVentaSelect = document.getElementById("punto_venta");

                                puntoVentaSelect.addEventListener("change", function() {
                                    if (puntoVentaSelect.value === "") {
                                        puntoVentaSelect.setCustomValidity("Debes seleccionar una opción");
                                    } else {
                                        puntoVentaSelect.setCustomValidity("");
                                    }
                                });
                            </script>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <label for="foto">Foto:</label>
                            <img id="imagenMiniatura" src="#" alt="Miniatura de la imagen"
                                style="display: none; max-width: 200px; max-height: 200px;">
                            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required>
                            <br>

                            <script>
                                var inputImagen = document.getElementById("imagen");
                                var imagenMiniatura = document.getElementById("imagenMiniatura");

                                inputImagen.addEventListener("change", function() {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        imagenMiniatura.src = e.target.result;
                                        imagenMiniatura.style.display = "block";
                                    };

                                    reader.readAsDataURL(inputImagen.files[0]);
                                });
                            </script>
                        </div>
                    </div>
                    <br>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-outline-success col-12 col-md-4">Guardar Factura</button>
                    </div>
            </form>
            <div class="container">


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Punto de Venta</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $factura)
                            <tr>
                                <td>{{ $factura->invoice_number }}</td>
                                <td>{{ $factura->point_sale }}</td>
                                <td>
                                    @if ($factura->image)
                                        <img src="{{ asset('images/' . $factura->image) }}" alt="Imagen del cliente"
                                            width="180px" height="100px">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-body-secondary text-center">
            Tienes <?php echo count($invoices); ?> facturas registradas
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error_message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error:',
                text: '{{ session('error_message') }}'
            });
        </script>
    @endif
    @if (session('message'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
