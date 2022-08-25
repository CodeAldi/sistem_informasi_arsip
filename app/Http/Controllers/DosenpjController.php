<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DosenpjController extends Controller
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
        return view('admin.dosenpj.dashboard', ['jumlahmahasiswa' => $JumlahMahasiswa, 'jumlahsertifikat' => $JumlahSertifikat, 'waiting' => $SertifikatWaitting, 'persen' => $hitung]);
    }
    public function listsertifikat()
    {
        $role = Auth()->user()->role;
        $sertifikat = DB::table('sertifikats')->join('users', 'sertifikats.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.prodi', 'sertifikats.*')->get();
        // dd($sertifikat);
        return view('admin.dosenpj.listsertifikat', ['sertifikat' => $sertifikat]);
    }
    public function verifikasi(Request $request)
    {
        $id = $request->id;
        $verifikasi = $request->verifikasi;
        $sertifikat = Sertifikat::find($id);
        $sertifikat->status_verifikasi = $verifikasi;
        $sertifikat->save();
        return redirect()->route('ListSemuaSertifikatProdi');
    }
}
