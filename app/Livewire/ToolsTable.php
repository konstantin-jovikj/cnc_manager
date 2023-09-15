<?php

namespace App\Livewire;

use App\Models\Tool;
use Livewire\Component;
use Livewire\WithPagination;

class ToolsTable extends Component
{
    // use WithPagination;

    // public $perPage = 10;
    public $search = '';
    public $selectedToolId;
    // public $Id;

    public function editTool($toolId)
    {
        // $this->selectedToolId = $toolId;
        $this->dispatch('tool-selected', id: $toolId);
    }

    public function render()
    {
        return view(
            'livewire.tools-table',
            [
                'tools' => Tool::search($this->search)->get()
            ]
        );
    }
}
