<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function masterTutorial()
    {
        return $this->belongsTo(MasterTutorial::class);
    }
}