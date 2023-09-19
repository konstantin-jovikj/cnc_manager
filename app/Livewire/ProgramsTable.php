<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Program;
use Livewire\Component;

class ProgramsTable extends Component
{

    public $search = '';
    public $isOpenNewProgram = 0;
    public $tools;
    public $selectedTools = [];
    public $name = '';
    public $program = '';
    public $note = '';
    public $allPrograms;
    public $programs;

    public function OpenNewProgramModul()
    {
        $this->isOpenNewProgram = true;
    }

    public function CloseNewProgramModul()
    {
        $this->isOpenNewProgram = false;
    }


    public function getTools()
    {
        $this->tools = Tool::all();
    }


    public function mount()
    {
        $this->getTools();
    }

    public function saveProgram()
    {
        $program = Program::create([
            'name' => $this->name,
            'program' => $this->program,
            'note' => $this->note
        ]);

        $program->save();

        session()->flash('success', 'New Program saved successfully.');
        $this->CloseNewProgramModul();
        $this->reset('name', 'program', 'note');
    }

    public function render()
    {
        if(! $this->search){
            $this->programs = Program::all();
        }else{
            $this->programs = Program::where('name', 'like', '%'.$this->search.'%')
                                        ->orWhere('note', 'like', '%'.$this->search.'%')->get();
        }
        return view('livewire.programs-table');
    }
}
