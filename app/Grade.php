<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['class_learn_id', 'class_room_id', 'semester_id', 'student_id', 'teacher_id', 'nilai_tugas_1', 'nilai_tugas_2', 'nilai_uts', 'nilai_uas'];

    public function classLearn()
    {
        return $this->belongsTo(ClassLearn::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }



    // public function schedule()
    // {
    //     return $this->hasMany(Schedule::class);
    // }
}
