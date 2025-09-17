<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Wajib Retribusi</title>
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
                        <h2>Tambah Wajib Retribusi</h2>
                        <form action="{{ route('multiadmin.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Masukkan Username" required>
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Pilih Level</option>
                                    <option value="Wajib Retribusi">Wajib Retribusi</option>
                                    <option value="Admin Aplikasi">Admin Aplikasi</option>
                                </select>
                                @error('level')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukkan Email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukkan Password" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <br>

                            <div id="wajib-retribusi-fields" style="display: none;">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="Masukkan Nama Lengkap" required>
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                        placeholder="Masukkan No HP" required>
                                    @error('no_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control"
                                        placeholder="Masukkan NIK" required>
                                    @error('nik')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="id_kelurahan">Kelurahan</label>
                                    <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                        <option value="">Pilih Kelurahan</option>
                                        @foreach ($kelurahans as $kelurahan)
                                            <option value="{{ $kelurahan->id }}">{{ $kelurahan->nama_kelurahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kelurahan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="id_ref_bank">Bank</label>
                                    <select name="id_ref_bank" id="id_ref_bank" class="form-control" required>
                                        <option value="">Pilih Bank</option>
                                        @foreach ($refBanks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_ref_bank')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="nama_akun">Nama Akun</label>
                                    <input type="text" name="nama_akun" id="nama_akun" class="form-control"
                                        placeholder="Masukkan Nama Akun" required>
                                    @error('nama_akun')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="no_rekening">No Rekening</label>
                                    <input type="text" name="no_rekening" id="no_rekening" class="form-control"
                                        placeholder="Masukkan No Rekening" required>
                                    @error('no_rekening')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            <a href="{{ route('wajib-retribusi.index') }}" class="btn btn-secondary mt-4">Kembali</a>
                        </form>
                        <script>
                            document.getElementById('level').addEventListener('change', function() {
                                const fields = document.getElementById('wajib-retribusi-fields');
                                fields.style.display = this.value === 'Wajib Retribusi' ? 'block' : 'none';

                                // Set all inputs in "wajib-retribusi-fields" to required if visible
                                const requiredFields = fields.querySelectorAll('input, select, textarea');
                                requiredFields.forEach(field => {
                                    if (this.value === 'Wajib Retribusi') {
                                        field.setAttribute('required', 'required');
                                    } else {
                                        field.removeAttribute('required');
                                    }
                                });
                            });
                        </script>

                    </div>

                    <script>
                        document.getElementById('level').addEventListener('change', function() {
                            const fields = document.getElementById('wajib-retribusi-fields');
                            fields.style.display = this.value === 'Wajib Retribusi' ? 'block' : 'none';
                        });
                    </script>
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
