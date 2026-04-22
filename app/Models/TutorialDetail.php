<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorialDetail extends Model
{
    protected $fillable = [
        'master_tutorial_id',
        'text',
        'gambar',
        'code',
        'url',
        'order',
        'status',
    ];

    public function masterTutorial()
    {
        return $this->belongsTo(MasterTutorial::class);
    }
}