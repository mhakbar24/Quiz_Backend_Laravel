<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Materi extends Model
{
    protected $fillable = [
    'title',
    'description',
    'image',
    'teacher_id'
];

 public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
