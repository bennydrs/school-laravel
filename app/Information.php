<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';
    protected $fillable = ['judul', 'konten', 'user_id', 'updated_by', 'publish'];
    protected $dates = ['created_at'];
}
