<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class ViewProgram extends Component
{
    public $program;
    public $programTools;
    public $notes;


    public function render()
    {
        // $notes = Note::where('program_id', $id)->get();
        return view('livewire.view-program');
    }
}
