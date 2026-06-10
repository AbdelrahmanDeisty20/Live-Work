<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'title',
        'value',
        'percentage',
        'skill_id',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
