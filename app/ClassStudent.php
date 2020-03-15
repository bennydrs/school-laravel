<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $fillable = ['student_id', 'semester_id', 'class_room_id'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
