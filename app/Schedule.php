<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    // protected $with = array('classlearn');
    protected $fillable = ['hari', 'jam_mulai', 'jam_selesai', 'class_room_id', 'class_learn_id', 'semester_id', 'teacher_id'];

    public function classLearn()
    {
        return $this->belongsTo(ClassLearn::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // public function grade()
    // {
    //     return $this->belongsTo(Grade::class);
    // }
}
