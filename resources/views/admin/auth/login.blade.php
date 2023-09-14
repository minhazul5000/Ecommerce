<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign in</h3>
                        <form action="{{route('adminLogin')}}" method="post">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>


                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                        </form>
                        <hr class="my-4">

                        <a href="#" class="text-secondary text-decoration-none">Fogot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



</body>
</html>

