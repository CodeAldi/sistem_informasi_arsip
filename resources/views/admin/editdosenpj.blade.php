@extends('layouts.dashboardlayout')

@section('content')

    <div id="content-wrapper" class="d-flex flex-column">
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
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit :{{ $dosenpj->name }}</h1>
                </div>

                <form action="{{ route('editdosenpj', ['id'=>$dosenpj->id]) }}" class="m-5" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id">ID :</label>
                        <input type="text" name="id" class="form-control form-control-user"
                            id="id"
                            placeholder="Enter Name..." value="{{ $dosenpj->id }} " disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama :</label>
                        <input type="text" name="name" class="form-control form-control-user"
                            id="name"
                            placeholder="Enter Name..." value="{{ $dosenpj->name }}">
                    </div>
                    <div class="form-group">
                        <label for="username">Username / NIDN :</label>
                        <input type="text" name="username" class="form-control form-control-user"
                            id="username" disabled
                            placeholder="Enter NIDN as Username..." value="{{ $dosenpj->username }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" name="password" class="form-control form-control-user"
                            id="password" placeholder="Password lama" disabled value="{{ $dosenpj->password }}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Password baru">
                    </div>
                    <div class="form-group">
                        <label for="prodiselect">Program Studi</label>
                        <select class="form-control" name="role" id="prodiselect">
                            <option value="default">Pilih Program Studi dosen terkait</option>
                            <option value="Pendidikan sejarah" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan sejarah")
                                selected
                            @endif>Pendidikan sejarah</option>
                            <option value="Pendidikan bimbingan dan konseling" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan sejarah")
                                selected
                            @endif>Pendidikan bimbingan dan konseling</option>
                            <option value="Pendidikan bahasa indonesia" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan sejarah")
                                selected
                            @endif>Pendidikan bahasa indonesia</option>
                            <option value="Pendidikan bahasa ingris" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan sejarah")
                                selected
                            @endif>Pendidikan bahasa ingris </option>
                            <option value="Pendidikan biologi" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan biologi")
                                selected
                            @endif>Pendidikan biologi</option>
                            <option value="Pendidikan informatika" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan informatika")
                                selected
                            @endif>Pendidikan informatika</option>
                            <option value="Pendidikan fisika" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan fisika")
                                selected
                            @endif>Pendidikan fisika</option>
                            <option value="Pendidikan ekonomi" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan ekonomi")
                                selected
                            @endif>Pendidikan ekonomi</option>
                            <option value="Pendidikan geografi" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan geografi")
                                selected
                            @endif>Pendidikan geografi</option>
                            <option value="Pendidikan akuntansi" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan akuntansi")
                                selected
                            @endif>Pendidikan akuntansi</option>
                            <option value="Pendidikan pkn" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan pkn")
                                selected
                            @endif>Pendidikan pkn</option>
                            <option value="Pendidikan ips" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan ips")
                                selected
                            @endif>Pendidikan ips</option>
                            <option value="Pendidikan matematika" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan matematika")
                                selected
                            @endif>Pendidikan matematika</option>
                            <option value="Pendidikan sosiologi" @if ($dosenpj->role == "Dosen Pj Prodi Pendidikan sosiologi")
                                selected
                            @endif>Pendidikan sosiologi</option>
                        </select>
                    </div>
                    </div>
                    {{-- <a href="/handlelogin" class="btn btn-primary btn-user btn-block">
                        Login
                    </a> --}}
                    <button class="btn btn-primary btn-user col-xl">Update</button>
                </form>
                <a href="{{ route('ListDosenPj') }}" class="btn btn-danger col-xl mt-2">back</a>
            </div>
        </div>
    </div>
    
@endsection