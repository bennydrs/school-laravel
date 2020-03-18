<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $dates = ['tanggal_lahir'];
    protected $fillable = ['nrg', 'nama', 'user_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'telp', 'alamat', 'foto'];

    public function getFoto()
    {
        if (!$this->foto) {
            return asset('img/default.jpg');
        }

        return asset('img/guru' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRoom()
    {
        return $this->hasOne(ClassRoom::class);
    }

    // public function classRoom()
    // {
    //     return $this->BelongsTo(ClassRoom::class);
    // }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function homeroomTeacher()
    {
        return $this->hasMany(HomeroomTeacher::class);
    }
}
