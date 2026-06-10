<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecknical extends Model
{
    //
    protected $fillable = [
        'name',
        'work_id',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
