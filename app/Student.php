<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $dates = ['tanggal_lahir'];
    protected $fillable = ['nis', 'nama', 'user_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'foto', 'class_room_id'];

    public function getFoto()
    {
        if (!$this->foto) {
            return asset('img/default.jpg');
        }

        return asset('img/' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
