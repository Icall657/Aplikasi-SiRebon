<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi SiRepal</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="SiRepal.png" alt="" style="width: 77px; height: 77px;">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if (auth()->user()->level == 'Admin Aplikasi')
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">
                        <i class="fa fa-home"></i>
                        <span>beranda</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rekening.index') }}">
                        <i class="fa fa-credit-card"></i>
                        <span>Rekening Pembayaran Retribusi</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wajib-retribusi.index') }}">
                        <i class="fa fa-anchor"></i>
                        <span>Wajib Retribusi</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pembayaran-retribusi.index') }}">
                        <i class="fa fa-dollar-sign"></i>
                        <span>Pembayaran Retribusi</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jenis-kapal.index') }}">
                        <i class="fa fa-receipt"></i>
                        <span>Manajemen Biaya Retribusi</span></a>
                </li>

                <hr class="sidebar-divider my-0">
            @endif

            <!-- Divider -->
            @if (auth()->user()->level == 'Wajib Retribusi')
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profil.index') }}">
                        <i class="fa fa-address-card"></i>
                        <span>Profil</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kapalku.index') }}">
                        <i class="fa fa-ship"></i>
                        <span>Kapalku</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('konfirmasi.index') }}">
                        <i class="fa fa-check-circle"></i>
                        <span>Konfirmasi Pembayaran Retribusi</span></a>
                </li>

                <hr class="sidebar-divider my-0">
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kapal-wajib-retribusi.index') }}">
                    <i class="fa fa-exclamation-circle"></i>
                    <span>Kapal Wajib Retribusi</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Laporan
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('carilaporan.index') }}">
                    <i class="fa fa-search"></i>
                    <span>Cari Laporan</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->level }}</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!--- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">


                    </div>

                    <!-- Content Row -->
                    <form action="{{ route('konfirmasi.confirm') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!session('success') && !$errors->any())
                            <div class="alert alert-secondary">
                                <strong>Informasi:</strong> Silahkan Transfer ke <strong>172639482736</strong> atau <a
                                    href="#" id="scanQR" class="text-primary font-weight-bold">Scan QR</a>
                                dan unggah bukti screenshot pembayaran Anda.
                            </div>
                        @endif



                        <div class="form-group">
                            <label for="id_kapal">Nama Kapal</label>
                            <select id="id_kapal" name="id_kapal" class="form-control" required
                                onchange="updateNominal()">
                                <option value="">Pilih Kapal</option>
                                @foreach ($kapals as $kapal)
                                    <option value="{{ $kapal->id }}"
                                        data-biaya-retribusi="{{ $kapal->jenisKapal->biaya_retribusi }}"
                                        {{ old('id_kapal') == $kapal->id ? 'selected' : '' }}>
                                        {{ $kapal->nama_kapal }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_kapal'))
                                <small class="text-danger">{{ $errors->first('id_kapal') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nominal_transfer">Nominal Transfer (Rp)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" id="nominal_transfer_display" class="form-control" readonly
                                    required autocomplete="off" value="0">
                                <input type="hidden" name="nominal_transfer" id="nominal_transfer_hidden"
                                    value="0">
                            </div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("scanQR").addEventListener("click", function(event) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Scan QR Code untuk Pembayaran',
                                        text: 'Gunakan aplikasi e-banking atau e-wallet untuk scan kode ini.',
                                        imageUrl: '{{ asset('img/qrcode.jpg') }}',
                                        imageWidth: 240,
                                        imageHeight: 300,
                                        imageAlt: 'QR Code Pembayaran',
                                        confirmButtonText: 'Oke, Saya Mengerti',
                                        confirmButtonColor: '#3085d6',
                                    });
                                });
                            });
                        </script>
                        <script>
                            function updateNominal() {
                                const kapalSelect = document.getElementById('id_kapal');
                                const selectedOption = kapalSelect.options[kapalSelect.selectedIndex];
                                const biayaRetribusi = selectedOption.getAttribute('data-biaya-retribusi');
                                const nominalTransferDisplay = document.getElementById('nominal_transfer_display');
                                const nominalTransferHidden = document.getElementById('nominal_transfer_hidden');

                                if (biayaRetribusi) {
                                    const biayaAsli = Number(biayaRetribusi);
                                    const formattedValue = new Intl.NumberFormat('id-ID').format(biayaAsli);

                                    nominalTransferDisplay.value = formattedValue;

                                    nominalTransferHidden.value = biayaAsli;
                                } else {
                                    nominalTransferDisplay.value = '0';
                                    nominalTransferHidden.value = '0';
                                }
                            }
                        </script>

                        <div class="form-group">
                            <label for="id_ref_bank">Jenis Bank</label>
                            <select id="id_ref_bank" name="id_ref_bank" class="form-control" required>
                                <option value="">Pilih Jenis Bank</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}"
                                        {{ old('id_ref_bank') == $bank->id ? 'selected' : '' }}>
                                        {{ $bank->nama_bank }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_ref_bank'))
                                <small class="text-danger">{{ $errors->first('id_ref_bank') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="id_ms_rekening">Nomor Rekening</label>
                            <select id="id_ms_rekening" name="id_ms_rekening" class="form-control" required>
                                <option value="" disabled selected>Pilih Rekening</option>
                                @foreach ($msRekenings as $rekening)
                                    <option value="{{ $rekening->id }}"
                                        {{ old('id_ms_rekening') == $rekening->id ? 'selected' : '' }}>
                                        {{ $rekening->no_rekening }} ({{ $rekening->nama_akun }}) -
                                        {{ $rekening->refBank->nama_bank }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_ms_rekening'))
                                <small class="text-danger">{{ $errors->first('id_ms_rekening') }}</small>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="file_bukti">Bukti Pembayaran</label>
                            <div class="d-flex align-items-center">
                                <input type="file" name="file_bukti" id="file_bukti" class="form-control"
                                    accept="image/*" required onchange="previewImage(event)">
                                <button type="button" class="btn btn-danger btn-sm ml-2 d-none" id="resetFile"
                                    onclick="resetFileInput()">X</button>
                            </div>
                            @if ($errors->has('file_bukti'))
                                <small class="text-danger">{{ $errors->first('file_bukti') }}</small>
                            @endif
                            <br>
                            <img id="preview" src="#" alt="Preview Gambar"
                                class="img-thumbnail mt-2 d-none" style="max-width: 200px;">
                        </div>

                        <script>
                            function previewImage(event) {
                                let preview = document.getElementById('preview');
                                let file = event.target.files[0];
                                let resetBtn = document.getElementById('resetFile');

                                if (file) {
                                    let reader = new FileReader();
                                    reader.onload = function() {
                                        preview.src = reader.result;
                                        preview.classList.remove('d-none');
                                        resetBtn.classList.remove('d-none');
                                    }
                                    reader.readAsDataURL(file);
                                }
                            }

                            function resetFileInput() {
                                let fileInput = document.getElementById('file_bukti');
                                let preview = document.getElementById('preview');
                                let resetBtn = document.getElementById('resetFile');

                                fileInput.value = "";
                                preview.classList.add('d-none');
                                resetBtn.classList.add('d-none');
                            }
                        </script>


                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                    <!-- ISI KONTEN -->

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>2024 &copy; SiRepal. Dinas Komunikasi, Informatika & Statistik.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" Jika Anda Yakin Ingin Keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
