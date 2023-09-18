<?php

namespace App\Livewire;

use Livewire\Component;

class ProgramsTable extends Component
{

    public $isOpenNewProgram = 0;

    public function OpenNewProgramModul()
    {
        $this->isOpenNewProgram = true;
    }

    public function CloseNewProgramModul()
    {
        $this->isOpenNewProgram = false;
    }


    public function render()
    {
        return view('livewire.programs-table');
    }
}
