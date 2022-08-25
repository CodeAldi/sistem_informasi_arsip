<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sertifikat extends Authenticatable 
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_kegiatan',
        'nama_kegiatan',
        'jenis',
        'sebagai',
        'tingkat',
        'file_sertifikat',
        'status_verifikasi',
        'kredit_poin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
