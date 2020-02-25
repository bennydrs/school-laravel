<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['kode_mapel', 'nama'];

    public function classLearn()
    {
        return $this->hasMany(ClassLearn::class);
    }
}
