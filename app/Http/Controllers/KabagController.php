<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class KabagController extends Controller
{
    public function index()
    {
        $JumlahMahasiswa = User::all()->count();
        $JumlahSertifikat = Sertifikat::all()->count();
        $SertifikatWaitting = Sertifikat::where('status_verifikasi', '1')->count();
        if ($JumlahSertifikat == 0) {
            $hitung = 0;
            return view('admin.dashboard', ['jumlahmahasiswa' => $JumlahMahasiswa, 'jumlahsertifikat' => $JumlahSertifikat, 'waiting' => $SertifikatWaitting, 'persen' => $hitung]);
        }
        $hitung = ($SertifikatWaitting / $JumlahSertifikat) * 100;
        return view('admin.kabag.dashboard', ['jumlahmahasiswa' => $JumlahMahasiswa, 'jumlahsertifikat' => $JumlahSertifikat, 'waiting' => $SertifikatWaitting, 'persen' => $hitung]);
    }
    public function ListSemuaSertifikatKabag()
    {
        $sertifikat = DB::table('sertifikats')->join('users', 'sertifikats.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.prodi', 'sertifikats.*')->get();
        // dd($sertifikat);
        return view('admin.kabag.listsertifikat', ['sertifikat' => $sertifikat]);
    }

    public function template_pdf()
    {
        $sertifikat = Sertifikat::all();
        // dd($sertifikat);
        return view('admin.kabag.pdftemplate', ['sertifikat' => $sertifikat]);
    }
    public function cetak_pdf()
    {
        $sertifikat = Sertifikat::all();
        view()->share('sertifikat', $sertifikat);
        $pdf = PDF::loadView('admin.kabag.pdftemplate')->setOptions(['defaultFont' => 'roboco'])->setPaper('a4', 'landscape');
        $pdf->save('Laporan-sertifikat.pdf');
        return $pdf->download('Laporan-sertifikat.pdf');
    }
}
