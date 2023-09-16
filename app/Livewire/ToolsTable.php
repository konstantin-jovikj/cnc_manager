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

    public $tool;
    public $shape;
    public $station;
    public $position;
    public $dimension;
    public $drawing;
    public $toolid;
    public $isOpen = 0;


    public function editTool($toolId)
    {
        // $this->selectedToolId = $toolId;
        $this->dispatch('tool-selected', id: $toolId);
    }


    public function view($id)
    {

        $tool = Tool::findOrFail($id);
        $this->toolid = $id;
        $this->position = $tool->position;
        $this->station = $tool->body;
        $this->shape = $tool->shape;
        $this->dimension = $tool->dimension;
        $this->drawing = $tool->tool_drawing;

        $this->openModal();

    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
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
