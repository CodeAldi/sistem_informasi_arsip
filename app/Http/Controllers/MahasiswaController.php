<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::where('user_id', Auth()->user()->id)->get();
        $kredit_poin = 0;
        $cek = 0 ;
        $menunggu = 0 ;
        $ditolak = 0;
        foreach ($sertifikat as $item) {
            if ($item->status_verifikasi == 3) {
                $kredit_poin += $item->kredit_poin;
            }
            elseif($item->status_verifikasi == 2){
                $cek += 1;
            }
            elseif ($item->status_verifikasi == 1) {
                $menunggu += 1;
            }
            else{
                $ditolak = 0;
            }
        }
        $jumlah = $sertifikat->count();
        
        return view('mahasiswa/home')
        ->with('jumlah',$jumlah)
        ->with('kredit_poin',$kredit_poin)
        ->with('ditolak',$ditolak)
        ->with('menunggu',$menunggu);
    }
}
