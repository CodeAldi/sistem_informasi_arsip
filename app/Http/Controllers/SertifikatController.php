<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Http\Requests\StoreSertifikatRequest;
use App\Http\Requests\UpdateSertifikatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sertifikat = Sertifikat::where('user_id', Auth()->user()->id)->get();
        return view('mahasiswa.listsertifikat', ['sertifikat' => $sertifikat]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.createsertifikat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSertifikatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSertifikatRequest $request)
    {
        $validatedData = $request->validate([
            'jenis_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        $data = $request->jenis_kegiatan;
        $tingkat = $request->tingkat_kegiatan;
        $olah = $this->menentukanJenisKegiatan($data);
        $jenis_kegiatan = $olah['jenis'];
        $sebagai = $olah['sebagai'];
        $olah2 = $this->menentukanTingkatDanPoinKegiatan($tingkat, $sebagai, $jenis_kegiatan);
        $lingkup = $olah2['tingkat'];
        $poinnya = $olah2['poin'];
        $path_file = $request->file('file')->store('public/files');
        // dd($path_file);
        // dd($path_file,$sebagai, $jenis_kegiatan, $lingkup,$poinnya);
        // $fullpath_file = $nama_file;
        $sertifikat = [
            '_token' => $request->_token,
            'user_id' => $request->userid,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis' => $jenis_kegiatan,
            'sebagai' => $sebagai,
            'tingkat' => $lingkup,
            'file_sertifikat' => $path_file,
            'status_verifikasi' => 1,
            'kredit_poin' => $poinnya,
        ];
        $save = Sertifikat::create($sertifikat);
        return redirect()->route('ListSertifikat')->with('status', 'File Has Been Uploaded Successfully!!!');
    }

    /**
     * @param use Illuminate\Support\Str $var
     */
    private function menentukanJenisKegiatan(string $var)
    {
        $jenis_kegiatan = '';
        $sebagai = '';
        switch ($var) {
            case '11':
                $jenis_kegiatan = 'Mubes';
                $sebagai = 'Ketua Mubes';
                break;
            case '12':
                $jenis_kegiatan = 'Mubes';
                $sebagai = 'Anggota Mubes';
                break;
            case '21':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Ketua';
                break;
            case '22':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Wakil Ketua';
                break;
            case '23':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Sekretaris';
                break;
            case '24':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Bendahara';
                break;
            case '25':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Ketua Komisi';
                break;
            case '26':
                $jenis_kegiatan = 'Dewan Legislatif Mahasiswa';
                $sebagai = 'Anggota';
                break;
            case '31':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Ketua';
                break;
            case '32':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Wakil Ketua';
                break;
            case '33':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Sekretaris';
                break;
            case '34':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Bendahara';
                break;
            case '35':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Koordinator';
                break;
            case '36':
                $jenis_kegiatan = 'Badan Eksekutif Mahasiswa';
                $sebagai = 'Anggota';
                break;
            case '41':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Ketua';
                break;
            case '42':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Wakil Ketua';
                break;
            case '43':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Sekretaris';
                break;
            case '44':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Bendahara';
                break;
            case '45':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Koordinator';
                break;
            case '46':
                $jenis_kegiatan = 'Unit Kegiatan Mahasiswa';
                $sebagai = 'Anggota';
                break;
            case '51':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Ketua';
                break;
            case '52':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Wakil Ketua';
                break;
            case '53':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Sekretaris';
                break;
            case '54':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Bendahara';
                break;
            case '55':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Koordinator';
                break;
            case '56':
                $jenis_kegiatan = 'Himpunan Mahasiswa';
                $sebagai = 'Anggota';
                break;
            case '61':
                $jenis_kegiatan = 'Penelitian Non TA atau Skripsi';
                $sebagai = 'Ketua Penelitian';
                break;
            case '62':
                $jenis_kegiatan = 'Penelitian Non TA atau Skripsi';
                $sebagai = 'Anggota Penelitian';
                break;
            case '71':
                $jenis_kegiatan = 'Mengikuti Lomba Karya Tulis';
                $sebagai = 'Juara 1';
                break;
            case '72':
                $jenis_kegiatan = 'Mengikuti Lomba Karya Tulis';
                $sebagai = 'Juara 2';
                break;
            case '73':
                $jenis_kegiatan = 'Mengikuti Lomba Karya Tulis';
                $sebagai = 'Juara 3';
                break;
            case '74':
                $jenis_kegiatan = 'Mengikuti Lomba Karya Tulis';
                $sebagai = 'Non Juara';
                break;
            case '81':
                $jenis_kegiatan = 'Publikasi Jurnal';
                $sebagai = 'Penulis Utama';
                break;
            case '82':
                $jenis_kegiatan = 'Publikasi Jurnal';
                $sebagai = 'Penulis Pendamping';
                break;
            case '91':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Ketua';
                break;
            case '92':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Wakil Ketua';
                break;
            case '93':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Sekretaris';
                break;
            case '94':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Bendahara';
                break;
            case '95':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Koordinator';
                break;
            case '96':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Anggota Koordinator';
                break;
            case '97':
                $jenis_kegiatan = 'Seminar/ceramah/diskusi';
                $sebagai = 'Peserta';
                break;
            case '101':
                $jenis_kegiatan = 'Simak STKIP PGRI';
                $sebagai = 'Ketua';
                break;
            case '102':
                $jenis_kegiatan = 'Simak STKIP PGRI';
                $sebagai = 'Anggota';
                break;
            case '103':
                $jenis_kegiatan = 'Simak STKIP PGRI';
                $sebagai = 'Peserta';
                break;
            case '111':
                $jenis_kegiatan = 'Latihan Dasar Kepemimpinan Mahasiswa';
                $sebagai = 'Ketua';
                break;
            case '112':
                $jenis_kegiatan = 'Latihan Dasar Kepemimpinan Mahasiswa';
                $sebagai = 'Anggota';
                break;
            case '113':
                $jenis_kegiatan = 'Latihan Dasar Kepemimpinan Mahasiswa';
                $sebagai = 'Peserta';
                break;
            case '121':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Ketua';
                break;
            case '122':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Wakil Ketua';
                break;
            case '123':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Sekretaris';
                break;
            case '124':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Bendahara';
                break;
            case '125':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Koordinator';
                break;
            case '126':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Anggota Koordinator';
                break;
            case '127':
                $jenis_kegiatan = 'Lomba / Pementasan';
                $sebagai = 'Peserta';
                break;
            case '131':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Ketua';
                break;
            case '132':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Wakil Ketua';
                break;
            case '133':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Sekretaris';
                break;
            case '134':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Bendahara';
                break;
            case '135':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Koordinator';
                break;
            case '136':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Anggota Koordinator';
                break;
            case '137':
                $jenis_kegiatan = 'Kegiatan Kepanitian';
                $sebagai = 'Peserta';
                break;
            case '141':
                $jenis_kegiatan = 'Olahraga';
                $sebagai = 'Juara 1';
                break;
            case '142':
                $jenis_kegiatan = 'Olahraga';
                $sebagai = 'Juara 2';
                break;
            case '143':
                $jenis_kegiatan = 'Olahraga';
                $sebagai = 'Juara 3';
                break;
            case '144':
                $jenis_kegiatan = 'Olahraga';
                $sebagai = 'Non Juara';
                break;
            case '151':
                $jenis_kegiatan = 'Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk';
                $sebagai = 'Petugas';
                break;
            case '152':
                $jenis_kegiatan = 'Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk';
                $sebagai = 'Peserta';
                break;
            case '161':
                $jenis_kegiatan = 'Kegiatan Tugas dari Kampus Lebih dari 7 hari dg dilengkapi sk';
                $sebagai = 'Petugas';
                break;
            case '162':
                $jenis_kegiatan = 'Kegiatan Tugas dari Kampus Lebih dari 7 hari dg dilengkapi sk';
                $sebagai = 'Peserta';
                break;

            default:
                $jenis_kegiatan = '';
                break;
        }
        return ['jenis' => $jenis_kegiatan, 'sebagai' => $sebagai];
    }
    private function menentukanTingkatDanPoinKegiatan(String $var, $sebagai, $jenis)
    {
        $tingkat_kegiatan = '';
        $poin = 0;
        if (($var >= 1) && ($var <= 4)) {
            $tingkat_kegiatan = 'Organisasi Mahasiswa : Universitas';
            switch ($jenis) {
                case 'Mubes':
                    switch ($sebagai) {
                        case 'Ketua Mubes':
                            $poin = 3;
                            break;
                        case 'Anggota Mubes':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Dewan Legislatif Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 20;
                            break;
                        case 'Wakil Ketua':
                            $poin = 19;
                            break;
                        case 'Sekretaris':
                            $poin = 18;
                            break;
                        case 'Bendahara':
                            $poin = 17;
                            break;
                        case 'Ketua Komisi':
                            $poin = 16;
                            break;
                        case 'Anggota':
                            $poin = 10;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Badan Eksekutif Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 20;
                            break;
                        case 'Wakil Ketua':
                            $poin = 19;
                            break;
                        case 'Sekretaris':
                            $poin = 18;
                            break;
                        case 'Bendahara':
                            $poin = 17;
                            break;
                        case 'Koordinator':
                            $poin = 16;
                            break;
                        case 'Anggota':
                            $poin = 10;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Unit Kegiatan Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 18;
                            break;
                        case 'Wakil Ketua':
                            $poin = 17;
                            break;
                        case 'Sekretaris':
                            $poin = 16;
                            break;
                        case 'Bendahara':
                            $poin = 15;
                            break;
                        case 'Koordinator':
                            $poin = 14;
                            break;
                        case 'Anggota':
                            $poin = 9;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;

                default:
                    $poin = 0;
                    break;
            }
        } elseif ($var == 5) {
            $tingkat_kegiatan = 'Organisasi Mahasiswa : Prodi';
            switch ($sebagai) {
                case 'Ketua':
                    $poin = 18;
                    break;
                case 'Wakil Ketua':
                    $poin = 17;
                    break;
                case 'Sekretaris':
                    $poin = 16;
                    break;
                case 'Bendahara':
                    $poin = 15;
                    break;
                case 'Koordinator':
                    $poin = 14;
                    break;
                case 'Anggota':
                    $poin = 8;
                    break;

                default:
                    $poin = 0;
                    break;
            }
        } elseif (($var >= 6) && ($var <= 14)) {
            $tingkat_kegiatan = 'Tingkat : Prodi';
            switch ($jenis) {
                case 'Penelitian Non TA atau Skripsi':
                    switch ($sebagai) {
                        case 'Ketua Penelitian':
                            $poin = 7;
                            break;
                        case 'Anggota Penelitian':
                            $poin = 5;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Mengikuti Lomba Karya Tulis':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 7;
                            break;
                        case 'Juara 2':
                            $poin = 5;
                            break;
                        case 'Juara 3':
                            $poin = 3;
                            break;
                        case 'Non Juara':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Publikasi Jurnal':
                    switch ($sebagai) {
                        case 'Penulis Utama':
                            $poin = 3;
                            break;
                        case 'Penulis Pendamping':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Seminar/ceramah/diskusi':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 3;
                            break;
                        case 'Wakil Ketua':
                            $poin = 3;
                            break;
                        case 'Sekretaris':
                            $poin = 3;
                            break;
                        case 'Bendahara':
                            $poin = 3;
                            break;
                        case 'Koordinator':
                            $poin = 3;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 2;
                            break;
                        case 'Peserta':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Simak STKIP PGRI':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 3;
                            break;
                        case 'Anggota':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Latihan Dasar Kepemimpinan Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 3;
                            break;
                        case 'Anggota':
                            $poin = 2;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Lomba / Pementasan':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 3;
                            break;
                        case 'Wakil Ketua':
                            $poin = 3;
                            break;
                        case 'Sekretaris':
                            $poin = 3;
                            break;
                        case 'Bendahara':
                            $poin = 3;
                            break;
                        case 'Koordinator':
                            $poin = 3;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 2;
                            break;
                        case 'Peserta':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Kepanitian':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 3;
                            break;
                        case 'Wakil Ketua':
                            $poin = 3;
                            break;
                        case 'Sekretaris':
                            $poin = 3;
                            break;
                        case 'Bendahara':
                            $poin = 3;
                            break;
                        case 'Koordinator':
                            $poin = 3;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 2;
                            break;
                        case 'Peserta':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Olahraga':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 3;
                            break;
                        case 'Juara 2':
                            $poin = 2;
                            break;
                        case 'Juara 3':
                            $poin = 1;
                            break;
                        case 'Non Juara':
                            $poin = 0;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;


                default:
                    $poin = 0;
                    break;
            }
        } elseif (($var >= 15) && ($var <= 25)) {
            $tingkat_kegiatan = 'Tingkat : Instansi kampus / Kabupaten / Kota';
            switch ($jenis) {
                case 'Penelitian Non TA atau Skripsi':
                    switch ($sebagai) {
                        case 'Ketua Penelitian':
                            $poin = 10;
                            break;
                        case 'Anggota Penelitian':
                            $poin = 7;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Mengikuti Lomba Karya Tulis':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 10;
                            break;
                        case 'Juara 2':
                            $poin = 7;
                            break;
                        case 'Juara 3':
                            $poin = 5;
                            break;
                        case 'Non Juara':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Publikasi Jurnal':
                    switch ($sebagai) {
                        case 'Penulis Utama':
                            $poin = 5;
                            break;
                        case 'Penulis Pendamping':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Seminar/ceramah/diskusi':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 4;
                            break;
                        case 'Wakil Ketua':
                            $poin = 4;
                            break;
                        case 'Sekretaris':
                            $poin = 4;
                            break;
                        case 'Bendahara':
                            $poin = 4;
                            break;
                        case 'Koordinator':
                            $poin = 4;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Simak STKIP PGRI':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 4;
                            break;
                        case 'Anggota':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Latihan Dasar Kepemimpinan Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 4;
                            break;
                        case 'Anggota':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Lomba / Pementasan':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 4;
                            break;
                        case 'Wakil Ketua':
                            $poin = 4;
                            break;
                        case 'Sekretaris':
                            $poin = 4;
                            break;
                        case 'Bendahara':
                            $poin = 4;
                            break;
                        case 'Koordinator':
                            $poin = 4;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Kepanitian':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 4;
                            break;
                        case 'Wakil Ketua':
                            $poin = 4;
                            break;
                        case 'Sekretaris':
                            $poin = 4;
                            break;
                        case 'Bendahara':
                            $poin = 4;
                            break;
                        case 'Koordinator':
                            $poin = 4;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Olahraga':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 4;
                            break;
                        case 'Juara 2':
                            $poin = 3;
                            break;
                        case 'Juara 3':
                            $poin = 2;
                            break;
                        case 'Non Juara':
                            $poin = 0;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk':
                    switch ($sebagai) {
                        case 'Petugas':
                            $poin = 2;
                            break;
                        case 'Peserta':
                            $poin = 1;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Tugas dari Kampus lebih dari 7 hari dg dilengkapi sk':
                    switch ($sebagai) {
                        case 'Peserta':
                            $poin = 7;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;

                default:
                    $poin = 0;
                    break;
            }
        } elseif (($var >= 26) && ($var <= 34)) {
            $tingkat_kegiatan = 'Tingkat : Provinsi';
            switch ($jenis) {
                case 'Penelitian Non TA atau Skripsi':
                    switch ($sebagai) {
                        case 'Ketua Penelitian':
                            $poin = 15;
                            break;
                        case 'Anggota Penelitian':
                            $poin = 10;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Mengikuti Lomba Karya Tulis':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 15;
                            break;
                        case 'Juara 2':
                            $poin = 10;
                            break;
                        case 'Juara 3':
                            $poin = 7;
                            break;
                        case 'Non Juara':
                            $poin = 5;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Publikasi Jurnal':
                    switch ($sebagai) {
                        case 'Penulis Utama':
                            $poin = 7;
                            break;
                        case 'Penulis Pendamping':
                            $poin = 5;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Seminar/ceramah/diskusi':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 5;
                            break;
                        case 'Wakil Ketua':
                            $poin = 5;
                            break;
                        case 'Sekretaris':
                            $poin = 5;
                            break;
                        case 'Bendahara':
                            $poin = 5;
                            break;
                        case 'Koordinator':
                            $poin = 5;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 4;
                            break;
                        case 'Peserta':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;

                case 'Latihan Dasar Kepemimpinan Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 5;
                            break;
                        case 'Anggota':
                            $poin = 4;
                            break;
                        case 'Peserta':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Lomba / Pementasan':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 5;
                            break;
                        case 'Wakil Ketua':
                            $poin = 5;
                            break;
                        case 'Sekretaris':
                            $poin = 5;
                            break;
                        case 'Bendahara':
                            $poin = 5;
                            break;
                        case 'Koordinator':
                            $poin = 5;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 4;
                            break;
                        case 'Peserta':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Kepanitian':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 5;
                            break;
                        case 'Wakil Ketua':
                            $poin = 5;
                            break;
                        case 'Sekretaris':
                            $poin = 5;
                            break;
                        case 'Bendahara':
                            $poin = 5;
                            break;
                        case 'Koordinator':
                            $poin = 5;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 4;
                            break;
                        case 'Peserta':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Olahraga':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 5;
                            break;
                        case 'Juara 2':
                            $poin = 4;
                            break;
                        case 'Juara 3':
                            $poin = 3;
                            break;
                        case 'Non Juara':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk':
                    switch ($sebagai) {
                        case 'Petugas':
                            $poin = 3;
                            break;
                        case 'Peserta':
                            $poin = 2;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;


                default:
                    $poin = 0;
                    break;
            }
        } elseif (($var >= 35) && ($var <= 43)) {
            $tingkat_kegiatan = 'Tingkat : Nasional';
            switch ($jenis) {
                case 'Penelitian Non TA atau Skripsi':
                    switch ($sebagai) {
                        case 'Ketua Penelitian':
                            $poin = 17;
                            break;
                        case 'Anggota Penelitian':
                            $poin = 15;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Mengikuti Lomba Karya Tulis':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 17;
                            break;
                        case 'Juara 2':
                            $poin = 15;
                            break;
                        case 'Juara 3':
                            $poin = 10;
                            break;
                        case 'Non Juara':
                            $poin = 7;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Publikasi Jurnal':
                    switch ($sebagai) {
                        case 'Penulis Utama':
                            $poin = 10;
                            break;
                        case 'Penulis Pendamping':
                            $poin = 7;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Seminar/ceramah/diskusi':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 6;
                            break;
                        case 'Wakil Ketua':
                            $poin = 6;
                            break;
                        case 'Sekretaris':
                            $poin = 6;
                            break;
                        case 'Bendahara':
                            $poin = 6;
                            break;
                        case 'Koordinator':
                            $poin = 6;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 5;
                            break;
                        case 'Peserta':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;

                case 'Latihan Dasar Kepemimpinan Mahasiswa':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 6;
                            break;
                        case 'Anggota':
                            $poin = 5;
                            break;
                        case 'Peserta':
                            $poin = 5;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Lomba / Pementasan':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 6;
                            break;
                        case 'Wakil Ketua':
                            $poin = 6;
                            break;
                        case 'Sekretaris':
                            $poin = 6;
                            break;
                        case 'Bendahara':
                            $poin = 6;
                            break;
                        case 'Koordinator':
                            $poin = 6;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 5;
                            break;
                        case 'Peserta':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Kepanitian':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 6;
                            break;
                        case 'Wakil Ketua':
                            $poin = 6;
                            break;
                        case 'Sekretaris':
                            $poin = 6;
                            break;
                        case 'Bendahara':
                            $poin = 6;
                            break;
                        case 'Koordinator':
                            $poin = 6;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 5;
                            break;
                        case 'Peserta':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Olahraga':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 8;
                            break;
                        case 'Juara 2':
                            $poin = 7;
                            break;
                        case 'Juara 3':
                            $poin = 6;
                            break;
                        case 'Non Juara':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Kegiatan Tugas dari Kampus kurang dari 7 hari dg dilengkapi sk':
                    switch ($sebagai) {
                        case 'Petugas':
                            $poin = 4;
                            break;
                        case 'Peserta':
                            $poin = 3;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;


                default:
                    $poin = 0;
                    break;
            }
        } elseif (($var >= 44) && ($var <= 48)) {
            $tingkat_kegiatan = 'Tingkat : Interasional';
            switch ($jenis) {
                case 'Penelitian Non TA atau Skripsi':
                    switch ($sebagai) {
                        case 'Ketua Penelitian':
                            $poin = 20;
                            break;
                        case 'Anggota Penelitian':
                            $poin = 17;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Mengikuti Lomba Karya Tulis':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 20;
                            break;
                        case 'Juara 2':
                            $poin = 17;
                            break;
                        case 'Juara 3':
                            $poin = 15;
                            break;
                        case 'Non Juara':
                            $poin = 10;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Publikasi Jurnal':
                    switch ($sebagai) {
                        case 'Penulis Utama':
                            $poin = 12;
                            break;
                        case 'Penulis Pendamping':
                            $poin = 10;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Seminar/ceramah/diskusi':
                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 7;
                            break;
                        case 'Wakil Ketua':
                            $poin = 7;
                            break;
                        case 'Sekretaris':
                            $poin = 7;
                            break;
                        case 'Bendahara':
                            $poin = 7;
                            break;
                        case 'Koordinator':
                            $poin = 7;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 6;
                            break;
                        case 'Peserta':
                            $poin = 5;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;


                    switch ($sebagai) {
                        case 'Ketua':
                            $poin = 6;
                            break;
                        case 'Wakil Ketua':
                            $poin = 6;
                            break;
                        case 'Sekretaris':
                            $poin = 6;
                            break;
                        case 'Bendahara':
                            $poin = 6;
                            break;
                        case 'Koordinator':
                            $poin = 6;
                            break;
                        case 'Anggota Koordinator':
                            $poin = 5;
                            break;
                        case 'Peserta':
                            $poin = 4;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                case 'Olahraga':
                    switch ($sebagai) {
                        case 'Juara 1':
                            $poin = 11;
                            break;
                        case 'Juara 2':
                            $poin = 10;
                            break;
                        case 'Juara 3':
                            $poin = 9;
                            break;
                        case 'Non Juara':
                            $poin = 6;
                            break;

                        default:
                            $poin = 0;
                            break;
                    }
                    break;
                default:
                    $poin = 0;
                    break;
            }
        } else {
            $tingkat_kegiatan = 'Tingkat : tidak terdaftar';
            $poin = 0;
        }
        return ['tingkat' => $tingkat_kegiatan, 'poin' => $poin];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sertifikat  $sertifikat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sertifikat = Sertifikat::find($request->id);
        // dd($sertifikat);
        return view('mahasiswa.showsertifikat')->with('lama', $sertifikat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sertifikat  $sertifikat
     * @return \Illuminate\Http\Response
     */
    public function edit(Sertifikat $sertifikat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sebagai = null;
        $lingkup = null;
        $poinnya = null;
        $sertifikat = Sertifikat::find($request->sertifikatid);
        if ($request->jenis_kegiatan != 'default') {
            $data = $request->jenis_kegiatan;
            $olah = $this->menentukanJenisKegiatan($data);
            $jenis_kegiatan = $olah['jenis'];
            $sebagai = $olah['sebagai'];
        }
        if ($request->tingkat_kegiatan != 'default') {
            $tingkat = $request->tingkat_kegiatan;
            $olah2 = $this->menentukanTingkatDanPoinKegiatan($tingkat, $sebagai, $jenis_kegiatan);
            $lingkup = $olah2['tingkat'];
            $poinnya = $olah2['poin'];
        }
        if ($request->tangal_kegiatan != null) {
            $sertifikat->tanggal_kegiatan = $request->tanggal_kegiatan;
            # code...
        }
        $sertifikat->nama_kegiatan = $request->nama_kegiatan;
        if (($sebagai != null) && ($lingkup != null)) {
            $sertifikat->jenis = $jenis_kegiatan;
            $sertifikat->sebagai = $sebagai;
            $sertifikat->tingkat = $lingkup;
            $sertifikat->kredit_poin = $poinnya;
        }
        $filelama = $sertifikat->file_sertifikat;
        $file = null;
        if ($request->file('file') != null) {
            $file = $request->file('file')->store('public/files');
            $sertifikat->file_sertifikat = $file;
            Storage::delete($filelama);
        }
        $sertifikat->update();
        return redirect()->route('ListSertifikat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sertifikat  $sertifikat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sertifikat = Sertifikat::find($request->id)->first();
        Storage::delete($sertifikat->file_sertifikat);
        $sertifikat->delete();
        return redirect()->route('ListSertifikat');
    }
}
