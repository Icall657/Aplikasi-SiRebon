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
                        <i class="fa fa-user"></i>
                        <span>Profil</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kapalku.index') }}">
                        <i class="fa fa-male"></i>
                        <span>Kapalku</span></a>
                </li>

                <hr class="sidebar-divider my-0">
                <li class="nav-item">
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
            <li class="nav-item active">
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

                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card shadow">
                                    <div class="card-header bg-primary text-white text-center">
                                        <h5 class="mb-0">Cari Laporan</h5>
                                    </div>

                                    @if (auth()->user()->level == 'Wajib Retribusi')
                                        <div class="card-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger text-danger">
                                                    {{ $errors->first() }}
                                                </div>
                                            @endif
                                            <form action="{{ route('laporan.index') }}" method="GET"
                                                autocomplete="off">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_awal" class="font-weight-bold">Tanggal
                                                                Awal</label>
                                                            <input type="date" name="tanggal_awal"
                                                                id="tanggal_awal" class="form-control rounded-pill"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_akhir"
                                                                class="font-weight-bold">Tanggal Akhir</label>
                                                            <input type="date" name="tanggal_akhir"
                                                                id="tanggal_akhir" class="form-control rounded-pill"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-lg rounded-pill">
                                                        <i class="fas fa-search"></i> Cari Laporan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer text-muted text-center">
                                            Pilih rentang tanggal untuk melihat laporan
                                        </div>
                                    @endif

                                    @if (auth()->user()->level == 'Admin Aplikasi')
                                        <div class="card-body">
                                            <div class="text-muted text-center">
                                                Pilih untuk melihat laporan
                                            </div>
                                            <div class="text-center mt-4">
                                                <a href="{{ route('retribusi.index') }}"
                                                    class="btn btn-secondary btn-lg rounded-pill">
                                                    <i class="fas fa-user"></i> Sudah Membayar Retribusi
                                                </a>
                                                <a href="{{ route('belum-retribusi.index') }}"
                                                    class="btn btn-secondary btn-lg rounded-pill ml-3">
                                                    <i class="fas fa-user-times"></i> Belum Membayar Retribusi
                                                </a>
                                            </div>

                                            <div class="card mt-4">
                                                <div
                                                    class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 d-flex align-items-center">
                                                        <span class="position-relative me-2">
                                                            <i class="fas fa-bell"></i>
                                                            <span id="notifBadge"
                                                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                                                                style="display: none; width: 8px; height: 8px; transform: translate(-30%, -30%);">
                                                            </span>
                                                        </span>
                                                        <span class="text-start">
                                                            <span style="visibility: hidden;">L</span>Notifikasi Pembayaran Terbaru
                                                        </span>
                                                    </h5>                                                    
                                                    <button class="btn btn-sm" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#notifikasiList"
                                                        aria-expanded="false" aria-controls="notifikasiList"
                                                        onclick="toggleIcon(this)">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>

                                                <div class="collapse" id="notifikasiList">
                                                    <ul class="list-group list-group-flush">
                                                        @if ($pembayaranTerbaru->isEmpty())
                                                            <li class="list-group-item text-center text-muted">
                                                                Belum ada pembayaran.
                                                            </li>
                                                        @else
                                                            @foreach ($pembayaranTerbaru as $bayar)
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <i
                                                                            class="fas fa-check-circle text-success"></i>
                                                                        <span
                                                                            class="font-weight-bold">{{ $bayar->user->username }}</span>
                                                                        telah melakukan pembayaran untuk kapal
                                                                        <span
                                                                            class="font-weight-bold">{{ $bayar->kapal->nama_kapal }}</span>
                                                                    </div>
                                                                    <small
                                                                        class="text-muted">{{ $bayar->created_at->diffForHumans() }}</small>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    let notifBadge = document.getElementById("notifBadge");
                                                    let notifList = document.getElementById("notifikasiList");
                                                    let pembayaranCount = {{ $pembayaranTerbaru->count() }};

                                                    if (pembayaranCount > 0) {
                                                        notifBadge.style.display = "inline-block";
                                                    }

                                                    notifList.addEventListener("show.bs.collapse", function() {
                                                        notifBadge.style.display = "none";
                                                    });
                                                });
                                            </script>

                                            <script>
                                                function toggleIcon(button) {
                                                    let icon = button.querySelector("i");
                                                    icon.classList.toggle("fa-chevron-down");
                                                    icon.classList.toggle("fa-chevron-up");
                                                }
                                            </script>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>



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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
