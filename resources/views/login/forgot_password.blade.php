<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('StyleLogin/Forgot-Password/style.css') }}" rel="stylesheet">
    <title>Lupa Password</title>
</head>

<body>
    <div class="container-fluid ">
        <form class="mx-auto" action="{{ route('password.email') }}" method="post">
            @csrf

            <h4 class="text-center mb-5">Lupa <span>Password</span></h4>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-0">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-3 mt-5">
                <label for="email" class="form-label">Masukkan Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" required autofocus>
                <a href="{{ route('login') }}" class="link-primary text-dark fw-large d-block mt-3"
                    style="text-decoration: none">Kembali</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>