<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoom extends Model
{
    protected $fillable = ['kode_kelas', 'nama', 'teacher_id'];

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
    public function setClass()
    {
        return $this->hasMany(SetClass::class);
    }
}
