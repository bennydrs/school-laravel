<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $dates = ['tanggal_lahir'];
    protected $fillable = ['nip', 'nama', 'user_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'telp', 'alamat', 'foto'];

    public function getFoto()
    {
        if (!$this->foto) {
            return asset('img/default.jpg');
        }

        return asset('img/admin' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
