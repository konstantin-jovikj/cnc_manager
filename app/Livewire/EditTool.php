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


    public $positions;
    public $tool;

    public $selectedPosition;
    public $Id;

    // #[On('tool-selected')]
    public function mount($tool)
    {
        // Call the getPosition method in the mount method to fetch the positions
        $this->getPosition();
        $this->tool = $tool;


    }

    public function getPosition()
    {
        $this->positions = Position::all();
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
