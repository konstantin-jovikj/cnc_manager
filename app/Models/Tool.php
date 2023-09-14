<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'used_tools', 'tool_id', 'program_id');
    }
}
