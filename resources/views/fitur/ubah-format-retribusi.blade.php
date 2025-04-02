<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Format Biaya Retribusi</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #4E73DF;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahData">Tambah
            Data</button>
        <div class="card p-3">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Jenis Kapal</th>
                        <th class="text-center">Biaya Retribusi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisKapal as $kapal)
                        <tr>
                            <td class="text-center">{{ $kapal->jenis_kapal }}</td>
                            <td class="text-center">Rp {{ number_format($kapal->biaya_retribusi, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-ubah" data-id="{{ $kapal->id }}"
                                    data-jenis="{{ $kapal->jenis_kapal }}" data-harga="{{ $kapal->biaya_retribusi }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ubah -->
    <!-- Modal Ubah -->
    <div class="modal fade" id="modalUbah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Biaya Retribusi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="kapalId">
                    <label for="kapalNama">Nama Kapal</label>
                    <input type="text" id="kapalNama" class="form-control">
                    <br>
                    <label for="biayaBaru">Biaya Baru</label>
                    <input type="text" id="biayaBaru" class="form-control"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kapal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="jenisKapal">Jenis Kapal</label>
                    <input type="text" id="jenisKapal" class="form-control">
                    <label for="biayaRetribusi" class="mt-2">Biaya Retribusi</label>
                    <input type="text" id="biayaRetribusi" class="form-control"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnTambah">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Ubah Data Kapal
            // Ubah Data Kapal
            $('.btn-ubah').click(function() {
                $('#kapalId').val($(this).data('id'));
                $('#kapalNama').val($(this).data('jenis')); // Mengisi nama kapal ke input
                $('#biayaBaru').val($(this).data('harga'));
                $('#modalUbah').modal('show'); // Memastikan modal muncul
            });

            // Simpan perubahan biaya retribusi dan nama kapal
            $('#btnSimpan').click(function() {
                let id = $('#kapalId').val();
                let namaKapal = $('#kapalNama').val();
                let biaya = $('#biayaBaru').val();

                // Validasi
                if (!namaKapal || !biaya) {
                    Swal.fire('Error', 'Semua kolom harus diisi!', 'error');
                    return;
                }

                if (!biaya.match(/^\d+$/)) {
                    Swal.fire('Error', 'Biaya harus berupa angka!', 'error');
                    return;
                }

                // Kirim data ke server
                $.post("{{ route('ubah-format-retribusi.update') }}", {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    jenis_kapal: namaKapal, // Nama kapal yang baru
                    biaya_retribusi: biaya // Biaya retribusi yang baru
                }, function(response) {
                    Swal.fire('Berhasil', response.success, 'success').then(() => {
                        location.reload();
                    });
                }).fail(function() {
                    Swal.fire('Error', 'Gagal mengupdate data kapal!', 'error');
                });
            });

            // Tambah Data Kapal
            $('#btnTambah').click(function() {
                let jenisKapal = $('#jenisKapal').val();
                let biaya = $('#biayaRetribusi').val();

                if (!biaya.match(/^\d+$/)) {
                    Swal.fire('Error', 'Biaya harus berupa angka!', 'error');
                    return;
                }

                $.post("{{ route('tambah-format-retribusi.store') }}", {
                    _token: "{{ csrf_token() }}",
                    jenis_kapal: jenisKapal,
                    biaya_retribusi: biaya
                }, function(response) {
                    Swal.fire('Berhasil', response.success, 'success').then(() => location
                        .reload());
                }).fail(function() {
                    Swal.fire('Error', 'Gagal menambahkan data!', 'error');
                });
            });
        });
    </script>

    <div class="text-center mt-3">
        <a href="{{ route('kapal-wajib-retribusi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>
