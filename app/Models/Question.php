<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $casts = [
        'is_required' => 'boolean',
        'choices' => 'array'
    ];

    protected $fillable = [
        'survey_id',
        'question_number',
        'type',
        'title',
        'is_required',
        'choices',
    ];

    protected $hidden = [
        'id'
    ];

    public $timestamps = false;

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
