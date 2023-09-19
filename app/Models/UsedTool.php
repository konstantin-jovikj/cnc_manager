<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'program_id',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
