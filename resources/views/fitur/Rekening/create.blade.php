<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Rekening Pembayaran SiRebon</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    body {
        background-color: #4E73DF;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card profile-card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Tambah Rekening Pembayaran</h5>
                        <hr>
                        <form action="{{ route('rekening.store') }}" method="POST">
                            @csrf
                            <!-- Pilih Bank -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="id_ref_bank">Nama Bank</label>
                                <div class="col-sm-9">
                                    <select name="id_ref_bank" id="id_ref_bank" class="form-select">
                                        @foreach ($refBanks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Nama Akun -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Akun</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_akun" class="form-control" required autocomplete="off">
                                </div>
                            </div>

                            <!-- Nomor Rekening -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nomor Rekening</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_rekening" class="form-control" required autocomplete="off">
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-secondary mt-4">Kembali</a>
                        </form>
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span class="text-muted">2024 &copy; SiRebon. Dinas Komunikasi, Informatika & Statistik.</span>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
