<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    protected $fillable = [
        'image',
        'title',
        'description',
        'link',
    ];

    public function tecknicals()
    {
        return $this->hasMany(Tecknical::class);
    }
}
