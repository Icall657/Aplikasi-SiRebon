<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SiRebon</title>

    <!-- FontAwesome & Google Fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- CSS Template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #4E73DF;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <!-- Form Login -->
                            <form action="{{ route('postlogin') }}" method="post">
                                {{ csrf_field() }}
                                <div class="brand-icon mb-3">
                                    <i class="fa fa-anchor fa-3x"></i>
                                </div>
                                <h3 class="mb-5"><strong>LOGIN SIREBON</strong></h3>

                                <div class="form-outline mb-4">
                                  <div style="text-align: left;">
                                      <label class="form-label">Username</label>
                                  </div>
                                  <div style="position: relative;" size="30">
                                      <i class="fa fa-user" style="position: absolute; left: 10px; top: 10px; color: #888;"></i>
                                      <input type="username" name="username" autocomplete="off" class="form-control form-control-lg" placeholder="Masukkan username" size="30" style="padding-left: 30px; height: 40px;" />
                                  </div>
                              </div>
          
                              <div class="form-outline mb-4">
                                <div style="text-align: left;">
                                    <label class="form-label">Password</label>
                                </div>
                                <div style="position: relative;" size="30">
                                    <i class="fa fa-lock" style="position: absolute; left: 10px; top: 10px; color: #888;"></i>
                                    <input id="password" type="password" name="password" autocomplete="off" class="form-control form-control-lg" placeholder="Masukkan password" size="30" style="padding-left: 30px; height: 40px;" />
                                    <i id="togglePassword" class="fa fa-eye" style="position: absolute; right: 10px; top: 10px; cursor: pointer; color: #888;"></i>
                                </div>
                            </div>
                            <div class="mb-4" style="text-align: left;">
                                <a href="#" class="text-primary">Lupa password?</a>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script toggle password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
