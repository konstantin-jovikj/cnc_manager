<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Shape;
use App\Models\Station;
use Livewire\Component;
use App\Models\Position;
use Illuminate\Validation\Rules\Dimensions;
use Livewire\Attributes\On;

class EditTool extends Component
{

    protected $listeners = ['editTool' => 'editTool'];

    // public $Id;
    public $positions;
    public $tool;
    public $shape;
    public $station;
    public $selectedPosition;
    public $position;
    public $dimension;
    public $drawing;
    public $toolid;
    public $Id;

    // #[On('tool-selected')]
    public function mount($tool)
    {
        // Call the getPosition method in the mount method to fetch the positions
        $this->getPosition();
        $this->tool = $tool;
        // $this->Id = $toolId;


    }

    public function getPosition()
    {
        $this->positions = Position::all();
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


    public function render()
    {
        return view('livewire.edit-tool',[
            'positions' => Position::all(),
            'shapes' => Shape::all(),
            'stations' => Station::all()
        ]);
    }


}
