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
    <section class="vh-100" style="background-color: #508bfc;">
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
                                      <label class="form-label">Email</label>
                                  </div>
                                  <div style="position: relative;" size="30">
                                      <i class="fa fa-user" style="position: absolute; left: 10px; top: 10px; color: #888;"></i>
                                      <input type="email" name="email" autocomplete="off" class="form-control form-control-lg" placeholder="Masukkan email" size="30" style="padding-left: 30px; height: 40px;" />
                                  </div>
                              </div>
          
                              <div class="form-outline mb-4">
                                  <div style="text-align: left;">
                                      <label class="form-label">Password</label>
                                  </div>
                                  <div style="position: relative;" size="30">
                                      <i class="fa fa-lock" style="position: absolute; left: 10px; top: 10px; color: #888;"></i>
                                      <input type="password" name="password" autocomplete="off" class="form-control form-control-lg" placeholder="Masukkan password" size="30" style="padding-left: 30px; height: 40px;" />
                                  </div>
                              </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">Ingatkan saya</label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- SweetAlert untuk Pesan Berhasil -->
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Lanjut'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('home') }}";
                    }
                });
            });
        </script>
    @endif

    <!-- SweetAlert untuk Pesan Gagal -->
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Login Gagal!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            });
        </script>
    @endif
   <!-- Script Vendor -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
