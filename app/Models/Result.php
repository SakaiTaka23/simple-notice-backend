<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
