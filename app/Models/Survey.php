<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable=[
        'owner',
        'delete_pass',
        'from',
        'to'
    ];

    public function question(){
        return $this->hasMany(Question::class);
    }

    public function result(){
        return $this->hasMany(Result::class);
    }
}
