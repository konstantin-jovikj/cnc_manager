<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'program',
        // 'note',
    ];

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'used_tools', 'program_id', 'tool_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }



}
