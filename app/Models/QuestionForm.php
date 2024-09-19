<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionForm extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'type', 'question'];

    public function answer() {
        return $this->hasMany(AnswerChse::class);
    }
}
