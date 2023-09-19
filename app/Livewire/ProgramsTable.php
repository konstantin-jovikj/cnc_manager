<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Program;
use App\Models\UsedTool;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ProgramsTable extends Component
{

    public $search = '';
    public $isOpenNewProgram = 0;
    public $isViewOpen = 0;
    public $tools;
    public $toolUsed = [];
    public $name = '';
    public $program = '';
    public $note = '';
    public $programs;
    public $newUsedTool;
    public $viewProgramName;
    public $viewProgramCode;

    public function OpenNewProgramModul()
    {
        $this->isOpenNewProgram = true;
    }

    public function CloseNewProgramModul()
    {
        $this->isOpenNewProgram = false;
    }

    public function openViewProgramModul($id)
    {
        $program = Program::findOrFail($id);
        $this->viewProgramName = $program->name;
        $this->viewProgramCode = $program->program;
        $this->isViewOpen = true;
    }

    public function closeViewProgramModul()
    {
        $this->isViewOpen = false;
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

        $lastRow = DB::table('programs')->get()->last();
        $nrOfTools = 0;

        if ($this->toolUsed != NULL){
            $nrOfTools = count($this->toolUsed);

            $i=0;
            for($i==0;$i<$nrOfTools; $i++){
                $newUsedTool = UsedTool::create([
                    'tool_id' => $this->toolUsed[$i],
                    'program_id' => $lastRow->id
                ]);
                $newUsedTool->save();
            }
        }


        session()->flash('success', 'New Program saved successfully.');
        $this->CloseNewProgramModul();
        $this->reset('name', 'program', 'note');
    }


    public function viewProgram($id)
    {

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
