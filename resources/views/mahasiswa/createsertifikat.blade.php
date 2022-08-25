@extends('layouts.mahasiswa')

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
                    <h1 class="h3 mb-0 text-gray-800">Upload berkas</h1>
                </div>

                <form action="{{ route('StoreSertifikat') }}" class="m-5" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='userid' value="{{ auth()->user()->id }}">
                    {{-- pilih kegiatan dan posisi --}}
                    <div class="form-group">
                        <label for="prodiselect">Jenis dan Posisi dalam kegiatan</label>
                        <select class="form-control" name="jenis_kegiatan" id="prodiselect">
                            <option value="default">Pilih Jenis dan Posisi dalam kegiatan anda</option>
                            <optgroup label="Muswawarah Besar">
                                <option value="11">Ketua</option>
                                <option value="12">Anggota</option>
                            </optgroup>
                            <optgroup label="Organisasi : Dewan Legislatif Mahasiswa">
                                <option value="21">Ketua</option>
                                <option value="22">Wakil</option>
                                <option value="23">Sekretaris</option>
                                <option value="24">Bendahara</option>
                                <option value="25">Ketua Komisi</option>
                                <option value="26">Anggota</option>
                            </optgroup>
                            <optgroup label="Organisasi : Badan Eksekutif Mahasiswa">
                                <option value="31">Ketua</option>
                                <option value="32">Wakil</option>
                                <option value="33">Sekretaris</option>
                                <option value="34">Bendahara</option>
                                <option value="35">Koordinator</option>
                                <option value="36">Anggota</option>
                            </optgroup>
                            <optgroup label="Organisasi : Unit Kegiatan Mahasiswa">
                                <option value="41">Ketua</option>
                                <option value="42">Wakil</option>
                                <option value="43">Sekretaris</option>
                                <option value="44">Bendahara</option>
                                <option value="45">Koordinator</option>
                                <option value="46">Anggota</option>
                            </optgroup>
                            <optgroup label="Organisasi : Himpunan Mahasiswa">
                                <option value="51">Ketua</option>
                                <option value="52">Wakil</option>
                                <option value="53">Sekretaris</option>
                                <option value="54">Bendahara</option>
                                <option value="55">Koordinator</option>
                                <option value="56">Anggota</option>
                            </optgroup>
                            <optgroup label="Penelitian Non TA atau Skripsi">
                                <option value="61">Ketua Penelitian</option>
                                <option value="62">Anggota Penelitian</option>
                            </optgroup>
                            <optgroup label="Mengikuti Lomba Karya Tulis">
                                <option value="71">Juara 1</option>
                                <option value="72">Juara 2</option>
                                <option value="73">Juara 3</option>
                                <option value="74">Non Juara</option>
                            </optgroup>
                            <optgroup label="Publikasi Jurnal">
                                <option value="81">Penulis Utama</option>
                                <option value="82">Penulis Pendamping</option>
                            </optgroup>
                            <optgroup label="Seminar/ceramah/diskusi">
                                <option value="91">Ketua</option>
                                <option value="92">Wakil</option>
                                <option value="93">Sekretaris</option>
                                <option value="94">Bendahara</option>
                                <option value="95">Koordinator</option>
                                <option value="96">Anggota Koordinator</option>
                                <option value="97">Peserta</option>
                            </optgroup>
                            <optgroup label="Simak STKIP PGRI">
                                <option value="101">Ketua</option>
                                <option value="102">Anggota</option>
                                <option value="103">Peserta</option>
                            </optgroup>
                            <optgroup label="Latihan Dasar Kepemimpinan Mahasiswa">
                                <option value="111">Ketua</option>
                                <option value="112">Anggota</option>
                                <option value="113">Peserta</option>
                            </optgroup>
                            <optgroup label="Lomba / Pementasan">
                                <option value="121">Ketua</option>
                                <option value="122">Wakil</option>
                                <option value="123">Sekretaris</option>
                                <option value="124">Bendahara</option>
                                <option value="125">Koordinator</option>
                                <option value="126">Anggota Koordinator</option>
                                <option value="127">Peserta</option>
                            </optgroup>
                            <optgroup label="Kegiatan Kepanitian">
                                <option value="131">Ketua</option>
                                <option value="132">Wakil</option>
                                <option value="133">Sekretaris</option>
                                <option value="134">Bendahara</option>
                                <option value="135">Koordinator</option>
                                <option value="136">Anggota Koordinator</option>
                                <option value="137">Peserta</option>
                            </optgroup>
                            <optgroup label="Olahraga">
                                <option value="141">Juara 1</option>
                                <option value="142">Juara 2</option>
                                <option value="143">Juara 3</option>
                                <option value="144">Non Juara</option>
                            </optgroup>
                            <optgroup label="Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk">
                                <option value="151">Petugas</option>
                                <option value="152">Peserta</option>
                            </optgroup>
                            <optgroup label="Kegiatan Tugas dari Kampus Lebih dari 7 hari dg dilengkapi sk">
                                <option value="161">Petugas</option>
                                <option value="162">Peserta</option>
                            </optgroup>
                        </select>
                    </div>
                    {{-- pilih tingkat kegiatan --}}
                    <div class="form-group">
                        <label for="prodiselect">Lingkup Atau Tingkat kegiatan</label>
                        <select class="form-control" name="tingkat_kegiatan" id="prodiselect">
                            <option value="default">Pilih Lingkup atau Tingkat kegiatan anda</option>
                            <optgroup label="Organisasi Mahasiswa : Universitas">
                                <option value="1">Mubes Mahasiswa</option>
                                <option value="2">Dewan Legislatif Mahasiswa</option>
                                <option value="3">Badan Eksekutif Mahasiswa</option>
                                <option value="4">Unit Kegiatan Mahasiswa</option>
                            </optgroup>
                            <optgroup label="Organisasi Mahasiswa : Prodi">
                                <option value="5">Himpunan Mahasiswa</option>
                            </optgroup>
                            <optgroup label="Tingkat Prodi">
                                <option value="6">Penelitian Non TA atau skripsi</option>
                                <option value="7">Lomba Karya Tulis</option>
                                <option value="8">Publikasi Karya Tulis</option>
                                <option value="9">Seminar / ceramah / diskusi</option>
                                <option value="10">Latihan Dasar Kepemimpinan Mahasiswa</option>
                                <option value="11">Lomba / Pementasan</option>
                                <option value="12">Kegiatan Kepanitiaa</option>
                                <option value="13">Olahraga</option>
                                <option value="14">Simak STIKIP PGRI | Prodi</option>
                            </optgroup>
                            <optgroup label="Tingkat Instansi Kampus atau Kabupaten atau Kota">
                                <option value="15">Penelitian Non TA atau skripsi</option>
                                <option value="16">Lomba Karya Tulis</option>
                                <option value="17">Publikasi Karya Tulis</option>
                                <option value="18">Seminar / ceramah / diskusi</option>
                                <option value="19">Latihan Dasar Kepemimpinan Mahasiswa</option>
                                <option value="20">Lomba / Pementasan</option>
                                <option value="21">Kegiatan Kepanitiaa</option>
                                <option value="22">Olahraga (juara 1,2,3)</option>
                                <option value="23">Simak STIKIP PGRI | Universitas</option>
                                <option value="24">Kegiatan tugas dari kampus kurang dari 7 hari dengan surat tugas</option>
                                <option value="25">Kegiatan tugas dari kampus lebih dari 7 hari dengan surat tugas</option>
                            </optgroup>
                            <optgroup label="Tingkat Provinsi">
                                <option value="26">Penelitian Non TA atau skripsi</option>
                                <option value="27">Lomba Karya Tulis</option>
                                <option value="28">Publikasi Karya Tulis</option>
                                <option value="29">Seminar / ceramah / diskusi</option>
                                <option value="30">Latihan Dasar Kepemimpinan Mahasiswa</option>
                                <option value="31">Lomba / Pementasan</option>
                                <option value="32">Kegiatan Kepanitiaa</option>
                                <option value="33">Olahraga (juara 1,2,3,non juara)</option>
                                <option value="34">Kegiatan tugas dari kampus kurang dari 7 hari dengan surat tugas</option>
                            </optgroup>
                            <optgroup label="Tingkat Nasional">
                                <option value="35">Penelitian Non TA atau skripsi</option>
                                <option value="36">Lomba Karya Tulis</option>
                                <option value="37">Publikasi Karya Tulis</option>
                                <option value="38">Seminar / ceramah / diskusi</option>
                                <option value="39">Latihan Dasar Kepemimpinan Mahasiswa</option>
                                <option value="40">Lomba / Pementasan</option>
                                <option value="41">Kegiatan Kepanitiaa</option>
                                <option value="42">Olahraga (juara 1,2,3,non juara)</option>
                                <option value="43">Kegiatan tugas dari kampus kurang dari 7 hari dengan surat tugas</option>
                            </optgroup>
                            <optgroup label="Tingkat Internasional">
                                <option value="44">Penelitian Non TA atau skripsi</option>
                                <option value="45">Lomba Karya Tulis</option>
                                <option value="46">Publikasi Karya Tulis</option>
                                <option value="47">Seminar / ceramah / diskusi</option>
                                <option value="48">Olahraga (juara 1,2,3,non juara)</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_kegiatan" class="form-control form-control-user"
                            id="exampleInputEmail"
                            placeholder="Masukan judul kegiatan atau deskripsi singkat tentang sertifikat...">
                    </div>
                    <div class="form-group xl-5">
                        <input type="date" name="tanggal_kegiatan" class="form-control form-control-date sm-2" onfocus="this.showPicker()"
                            placeholder="Pilih tanggal kegiatan atau tanggal kegaitan dimulai..." onkeydown="return false">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" id="file" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Upload file">
                            @error('file')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                    </div>
                    {{-- tingkat --}}
                    
                    <button class="btn btn-primary btn-user col-xl">Create</button>
                    <a href="{{ route('ListSertifikat') }}" class="btn btn-danger col-xl mt-2">back</a>
                </form>
            </div>
        </div>
    </div>
    
@endsection