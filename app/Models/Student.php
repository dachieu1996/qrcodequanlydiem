<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = ['id'];

    public function subjects(){
        return $this->belongsToMany((\App\Models\Subject::class))
                    ->withPivot('process_score', 'mid_score', 'end_score');
    }
}
