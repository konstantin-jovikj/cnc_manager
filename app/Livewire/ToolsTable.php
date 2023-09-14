<?php

namespace App\Livewire;

use App\Models\Tool;
use Livewire\Component;
use Livewire\WithPagination;

class ToolsTable extends Component
{
    use WithPagination;

    // public $perPage = 10;
    public $search = '';

    public function render()
    {
        return view('livewire.tools-table',
            [
                'tools' => Tool::search($this->search)->get()
            ]
        );
    }
}
