<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['kode_semester', 'semester', 'tahun_ajaran'];

    public function classLearn()
    {
        return $this->hasMany(ClassLearn::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }
}
