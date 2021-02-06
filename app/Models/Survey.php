<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $casts = [
        'from' => 'date',
        'to' => 'date'
    ];

    protected $fillable = [
        'owner',
        'delete_pass',
        'from',
        'to'
    ];

    protected $hidden = [
        'delete_pass',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
