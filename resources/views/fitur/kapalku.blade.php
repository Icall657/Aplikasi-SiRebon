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
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('kapalku.index') }}">
                        <i class="fa fa-ship"></i>
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

                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <form class="form-inline" method="GET" action="{{ route('kapalku.index') }}">
                            <div class="input-group bg-white p-1 rounded-lg shadow-sm">
                                <input type="text" class="form-control bg-white border border-gray-300 small"
                                    name="search" placeholder="Cari nama kapal..." aria-label="Search"
                                    aria-describedby="basic-addon2" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="table-container">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('kapalku.create') }}" class="btn btn-primary btn-add">Tambah
                                    Data</a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">No.</th>
                                <th style="width: 200px;" class="text-center">Nama Pemilik</th>
                                <th style="width: 150px;" class="text-center">Nama Kapal</th>
                                <th style="width: 150px;" class="text-center">Jenis Kapal</th>
                                <th style="width: 180px;" class="text-center">Ukuran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kapalData as $index => $kapal)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        {{ $kapal['user']['wajib_retribusi']['nama'] ?? 'Tidak diketahui' }}
                                    </td>
                                    <td class="text-center">{{ $kapal['nama_kapal'] }}</td>
                                    <td class="text-center">
                                        {{ $kapal['jenis_kapal']['jenis_kapal'] ?? 'Tidak diketahui' }}</td>
                                    <td class="text-center">{{ $kapal['ukuran'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        @if (session('success'))
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: '{{ session('success') }}',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        @endif
                    </script>



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

</body>

</html>
