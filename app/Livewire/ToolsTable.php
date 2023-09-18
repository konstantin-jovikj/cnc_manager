<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Shape;
use App\Models\Station;
use Livewire\Component;
use App\Models\Position;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ToolsTable extends Component
{

    use WithFileUploads;


    public $search = '';
    public $selectedToolId;


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

    #[Rule('nullable|sometimes|image')]
    public $drawingEdit;

    public $tool_drawing;

    public $toolid;
    public $isOpen = 0;
    public $isEditOpen = 0;

    public $isDeleteConfirmationOpen = 0;
    public $toolIdToDelete;


    public function editTool($toolId)
    {
        // $this->selectedToolId = $toolId;
        $this->dispatch('tool-selected', id: $toolId);
    }


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }


    public function OpenDeleteConfirmation($id)
    {

        $this->toolIdToDelete = $id;
        $this->isDeleteConfirmationOpen = true;
    }

    public function CloseDeleteConfirmation()
    {
        $this->isDeleteConfirmationOpen = false;
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

            $filename = $tool->tool_drawing; // Default to the existing filename

            if ($this->drawingEdit instanceof \Illuminate\Http\UploadedFile) {
                $filename = $this->toolid . '.' . $this->drawingEdit->getClientOriginalExtension();
                $this->drawingEdit->storeAs('public/images', $filename);
            }

            $tool->update([
                'position' => $this->positionEdit,
                'station' => $this->stationEdit,
                'shape' => $this->shapeEdit,
                'dimension' => $this->dimensionEdit,
                'tool_drawing' => $filename
            ]);

            session()->flash('success', 'Tool updated successfully.');
            $this->closeEditModal();
            $this->reset('positionEdit', 'stationEdit', 'shapeEdit', 'dimensionEdit', 'drawingEdit');
        }
    }


    public function delete()
    {
        if ($this->toolIdToDelete) {
            $tool = Tool::findOrFail($this->toolIdToDelete);
            $tool->delete();
            session()->flash('success', 'The Tool was deleted Successfully!!');

            // Reset the toolIdToDelete and close the modal
            $this->toolIdToDelete = null;
            $this->isDeleteConfirmationOpen = false;
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
