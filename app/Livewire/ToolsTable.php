<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Shape;
use App\Models\Station;
use Livewire\Component;
use App\Models\Position;
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


    public $shapeEdit;
    public $stationEdit;
    public $positionEdit;
    public $dimensionEdit;
    public $drawingEdit;

    public $tool_drawing;

    public $toolid;
    public $isOpen = 0;
    public $isEditOpen = 0;


    public function editTool($toolId)
    {
        // $this->selectedToolId = $toolId;
        $this->dispatch('tool-selected', id: $toolId);
    }

        // VIEW
    public function view($id)
    {

        $tool = Tool::findOrFail($id);
        $this->toolid = $id;
        $this->position = $tool->position;
        $this->station = $tool->station;
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


    // EDIT

    public function edit($id)
    {

        $tool = Tool::findOrFail($id);
        $this->toolid = $id;
        $this->positionEdit = $tool->position;
        $this->stationEdit = $tool->station;
        $this->shapeEdit = $tool->shape;
        $this->dimensionEdit = $tool->dimension;
        $this->drawingEdit = $tool->tool_drawing;

        $this->openEditModal();
    }

    public function openEditModal()
    {
        $this->isEditOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditOpen = false;
    }


    // UPDATE

    public function update()
    {
        if ($this->toolid) {
            $tool = Tool::findOrFail($this->toolid);
            $tool->update([
                'position' => $this->positionEdit,
                'station' => $this->stationEdit,
                'shape' => $this->shapeEdit,
                'dimension' => $this->dimensionEdit,
                'tool_drawing' => $this->drawingEdit
            ]);
            session()->flash('success', 'Tool updated successfully.');
            $this->closeEditModal();
            $this->reset('position', 'station', 'shape', 'dimension', 'tool_drawing');
        }
    }




    public function render()
    {
        return view(
            'livewire.tools-table',
            [
                'tools' => Tool::search($this->search)->get(),
                'positions' => Position::all(),
                'shapes' => Shape::all(),
                'stations' => Station::all(),
                'tool' => $this->tool
            ]
        );
    }
}
