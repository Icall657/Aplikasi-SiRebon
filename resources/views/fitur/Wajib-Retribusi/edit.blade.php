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
                        <h5 class="card-title text-center">Ubah Wajib Retribusi</h5>
                        <hr>
                        <form action="{{ route('wajib-retribusi.update', $wajib->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama', $wajib->nama) }}" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_hp">Nomor Telepon</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control"
                                    value="{{ old('no_hp', $wajib->no_hp) }}" required>
                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    value="{{ old('nik', $wajib->nik) }}" required>
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $wajib->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="id_kelurahan">Kelurahan</label>
                                <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                    <option value="" disabled>Pilih Kelurahan</option>
                                    @foreach ($kelurahans as $kelurahan)
                                        <option value="{{ $kelurahan->id }}"
                                            {{ old('id_kelurahan', $wajib->id_kelurahan) == $kelurahan->id ? 'selected' : '' }}>
                                            {{ $kelurahan->nama_kelurahan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelurahan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('wajib-retribusi.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skrip Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Skrip plugin dan kustom lainnya -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
