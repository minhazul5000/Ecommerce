<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
        {{--Bootstrap CSS--}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        {{--Bootstrap JS--}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('userDashboard')}}">Ecommerce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('userDashboard')}}">Home</a>
                        </li>
                        @if(!Auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('userLogin')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('userRegister')}}">Register</a>
                            </li>
                        @endif
                        @if(Auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('userLogout')}}">Logout</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </body>
</html>

