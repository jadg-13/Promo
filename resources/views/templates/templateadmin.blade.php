<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary ">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Promoción</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('customer.index')}}">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.customers')}}">Facturas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.user.show')}}">Usuarios</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.codes.index')}}">Códigos</a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </nav>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer class="container">
        @yield('footer')
    </footer>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
