<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Rekening Pembayaran SiRepal</title>
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
                        <h5 class="card-title text-center">Ubah Rekening Pembayaran</h5>
                        <hr>
                        <form action="{{ route('rekening.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="id_ref_bank">Jenis Bank</label>
                                <select name="id_ref_bank" id="id_ref_bank" class="form-control">
                                    @foreach ($refBanks as $bank)
                                        <option value="{{ $bank->id }}"
                                            {{ $data->id_ref_bank == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->nama_bank }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_ref_bank')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama_akun">Nama Pemilik</label>
                                <input type="text" name="nama_akun" id="nama_akun" class="form-control"
                                    value="{{ $data->nama_akun }}" required>
                                @error('nama_akun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_rekening">Nomor Rekening</label>
                                <input type="text" name="no_rekening" id="no_rekening" class="form-control"
                                    value="{{ $data->no_rekening }}" required>
                                @error('no_rekening')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('rekening.index') }}" class="btn btn-secondary">Batal</a>
                        </form>

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
