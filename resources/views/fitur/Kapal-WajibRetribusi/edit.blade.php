<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kapal Wajib Retribusi SiRebon</title>
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
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h5 class="card-title text-center">Edit Kapal Wajib Retribusi</h5>
                        <hr>
                        <form action="{{ route('kapal-wajib-retribusi.update', $kapal->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="id_user">Nama Pemilik</label>
                                <div class="col-sm-9">
                                <select name="id_user" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->wajibRetribusi)
                                            <option value="{{ $user->id }}"
                                                {{ $kapal->id_user == $user->id ? 'selected' : '' }}>
                                                {{ $user->wajibRetribusi->nama }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Kapal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_kapal" class="form-control"
                                        value="{{ $kapal->nama_kapal }}" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="id_jenis_kapal">Jenis Kapal</label>
                                <div class="col-sm-9">
                                    <select name="id_jenis_kapal" id="id_jenis_kapal" class="form-select" required>
                                        @foreach ($refJenisKapals as $jenisKapal)
                                            <option value="{{ $jenisKapal->id }}"
                                                {{ $kapal->id_jenis_kapal == $jenisKapal->id ? 'selected' : '' }}>
                                                {{ $jenisKapal->jenis_kapal }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Ukuran</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ukuran" class="form-control"
                                        value="{{ $kapal->ukuran }}" required autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            <a href="{{ route('kapal-wajib-retribusi.index') }}"
                                class="btn btn-secondary mt-4">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
