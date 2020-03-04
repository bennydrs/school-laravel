<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeroomTeacher extends Model
{
    protected $fillable = ['class_room_id', 'teacher_id', 'semester_id'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
