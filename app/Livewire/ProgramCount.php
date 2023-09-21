<?php

namespace App\Livewire;

use App\Models\Program;
use Livewire\Component;

class ProgramCount extends Component
{

    public $programs;


    public function countPrograms()
    {
        $this->programs = Program::count();
    }

    public function mount()
    {
        $this->countPrograms();
    }


    public function render()
    {
        return view('livewire.program-count',[
            'number_of_programs' => $this->programs
        ]);
    }
}
