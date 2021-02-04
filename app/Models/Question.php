<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question_number',
        'type',
        'name',
        'title',
        'is_required',
        'choices',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
