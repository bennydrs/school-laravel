<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetClass extends Model
{
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
