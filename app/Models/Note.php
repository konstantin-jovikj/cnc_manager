<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'note',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
