<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassLearn extends Model
{
    protected $fillable = ['class_room_id', 'semester_id', 'subject_id'];

    // protected $with = array('schedule');

    public function classRoom()
    {
        return $this->BelongsTo(ClassRoom::class);
    }

    public function teacher()
    {
        return $this->BelongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->BelongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->BelongsTo(Semester::class);
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
