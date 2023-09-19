<?php

namespace App\Livewire;

use Livewire\Component;

class ViewProgram extends Component
{
    public $program;
    public $programTools;

    public function render()
    {
        return view('livewire.view-program');
    }
}
