<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['quiz_id', 'student_id', 'score'];

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'result_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
