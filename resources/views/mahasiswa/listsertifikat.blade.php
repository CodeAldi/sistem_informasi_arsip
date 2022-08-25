@extends('layouts.mahasiswa')

@section('content')
    
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <span>Sistem Informasi Pengelolaan Pengarsipan Sertifikat</span>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">hi, {{ auth()->user()->name }}</span>
                        <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">List</h1>
            </div>
            

            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sertifikat Saya</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Tingkat</th>
                                    <th>Organisasi atau lingkup</th>
                                    <th>Posisi / Sebagai</th>
                                    <th>Poin</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Tingkat</th>
                                    <th>Organisasi atau lingkup</th>
                                    <th>Posisi / Sebagai</th>
                                    <th>Poin</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($sertifikat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->nama_kegiatan }}</td>
                                        <td>{{ $item->tanggal_kegiatan }}</td>
                                        <td>{{ $item->tingkat }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->sebagai }}</td>
                                        <td>{{ $item->kredit_poin }}</td>
                                        @if ($item->status_verifikasi == 1)
                                            <td><div class="btn btn-primary">Menunggu Verifikasi</div></td>
                                        @elseif($item->status_verifikasi == 2)
                                            <td><div class="btn btn-warning">Data Kurang / tidak valid</div></td>
                                        @elseif($item->status_verifikasi == 3)
                                            <td><div class="btn btn-success">Disetujui</div></td>
                                        @else
                                            <td><div class="btn btn-danger">Ditolak</div></td>
                                        @endif
                                        <td>
                                            <a href="{{ Storage::url($item->file_sertifikat) }}" class="btn btn-info btn-circle" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('ShowSertifikat') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-info btn-circle @if ($item->status_verifikasi == 3)
                                                disabled
                                            @endif" @if ($item->status_verifikasi == 3)
                                                disabled
                                            @endif><i class="fas fa-info-circle"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('DestroySertifikat') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Are You Sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Sistem pengelolaan kredit point sertifikat 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
@endsection