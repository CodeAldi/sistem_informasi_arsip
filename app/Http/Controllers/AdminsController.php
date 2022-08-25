<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admins;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('admin.dashboard', ['jumlahmahasiswa' => $JumlahMahasiswa, 'jumlahsertifikat' => $JumlahSertifikat, 'waiting' => $SertifikatWaitting, 'persen' => $hitung]);
    }

    //dosen pj
    public function listDosenPj()
    {
        // $dosenpj = Admins::where('level','0');
        $dosenpj = Admins::where('level', '=', '1')->get();
        return view('admin.list')->with('dosenpj', $dosenpj);
    }

    public function FormCreateDosenPj()
    {
        # untuk render form create dosen pj
        return view('admin.createdosenpj');
    }
    public function handlecreatedosenpj(Request $request)
    {
        # code...
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        $dosen = [
            '_token' => $request->_token,
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => '1',
            'role' => $request->role,
        ];
        // dd($dosen);
        $create = Admins::create($dosen);

        return redirect('/dashboard/create-dosen-pj');
    }

    public function formeditdosenpj($id)
    {
        $dosen = Admins::find($id);
        return view('admin.editdosenpj')->with('dosenpj', $dosen);
    }
    public function editdosenpj(Request $request, $id)
    {
        $dosenpj = Admins::find($id);
        $dosenpj->name = $request->name;
        if ($request->password) {
            $dosenpj->password = $request->password;
        }
        $dosenpj->role = $request->role;
        $dosenpj->save();
        return redirect('/dashboard/dosen-pj');
    }

    public function destroydosenpj(Request $request)
    {
        # code...
        $id = $request->id;
        $dosenpj = Admins::find($id);
        $dosenpj->delete();
        return redirect('/dashboard/dosen-pj');
    }

    //kabag
    public function listkabag()
    {
        // $kabag = Admins::where('level','0');
        $kabag = Admins::where('level', '=', '2')->get();
        return view('admin.listkabag')->with('kabag', $kabag);
    }

    public function FormCreatekabag()
    {
        # untuk render form create kabag
        return view('admin.createkabag');
    }
    public function handlecreatekabag(Request $request)
    {
        # code...
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'required',
        ]);
        $kabag = [
            '_token' => $request->_token,
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => '2',
            'role' => 'Kepala Bagian Kemahasiswaan',
        ];
        $create = Admins::create($kabag);
        // dd($kabag);

        return redirect('/dashboard/create-kabag');
    }

    public function formeditkabag($id)
    {
        $kabag = Admins::find($id);
        return view('admin.editkabag')->with('kabag', $kabag);
    }
    public function editkabag(Request $request, $id)
    {
        $kabag = Admins::find($id);
        $kabag->name = $request->name;
        if ($request->password) {
            $kabag->password = $request->password;
        }
        $kabag->save();
        return redirect('/dashboard/kabag');
    }

    public function destroykabag(Request $request)
    {
        # code...
        $id = $request->id;
        $kabag = Admins::find($id);
        $kabag->delete();
        return redirect('/dashboard/kabag');
    }
    //mahasiswa
    public function listMahasiswa()
    {
        // $kabag = Admins::where('level','0');
        $mahasiswa = User::all();
        return view('admin.listmahasiswa')->with('mahasiswa', $mahasiswa);
    }

    public function FormCreateMahasiswa()
    {
        # untuk render form create mahasiswa
        return view('admin.createmahasiswa');
    }
    public function handlecreateMahasiswa(Request $request)
    {
        # code...
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'required',
        ]);
        $mahasiswa = [
            '_token' => $request->_token,
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'prodi' => $request->prodi,
        ];
        $create = User::create($mahasiswa);
        // dd($mahasiswa);

        return redirect('/dashboard/create-mahasiswa');
    }

    public function formeditMahasiswa($id)
    {
        $mahasiswa = User::find($id);
        return view('admin.editmahasiswa')->with('mahasiswa', $mahasiswa);
    }
    public function editmahasiswa(Request $request, $id)
    {
        $mahasiswa = User::find($id);
        $mahasiswa->name = $request->name;
        if ($request->password) {
            $mahasiswa->password = $request->password;
        }
        $mahasiswa->save();
        return redirect('/dashboard/mahasiswa');
    }

    public function destroymahasiswa(Request $request)
    {
        # code...
        $id = $request->id;
        $mahasiswa = User::find($id);
        $mahasiswa->delete();
        return redirect('/dashboard/mahasiswa');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
