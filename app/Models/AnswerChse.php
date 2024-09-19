<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChse extends Model
{
    use HasFactory;

    protected $fillable = ['answer_id', 'question_form_id', 'answer', 'choice_form_id'];

    public function question_form() {
        return $this->belongsTo(QuestionForm::class);
    }
}
