<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoom extends Model
{
    protected $fillable = ['kode_kelas', 'nama'];

    public function teacher()
    {
        return $this->BelongsTo(Teacher::class);
    }

    public function classLearn()
    {
        return $this->hasMany(ClassLearn::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function classStudent()
    {
        return $this->hasMany(ClassStudent::class);
    }

    public function homeroomTeacher()
    {
        return $this->hasMany(HomeroomTeacher::class);
    }
}
