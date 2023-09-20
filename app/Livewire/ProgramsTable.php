<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Program;
use Livewire\Component;
use App\Models\UsedTool;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProgramsTable extends Component
{

    public $search = '';
    public $isOpenNewProgram = 0;
    public $isEditOpen = 0;
    public $isDeleteOpen = 0;
    public $tools;
    public $toolUsed = [];
    public $name = '';
    public $program = '';
    public $note = '';
    public $programs;
    public $newUsedTool;

    public $programId;
    public $editName;
    public $editProgram;
    public $editNote;

    public $usedTools = [];
    public $toolUsedEdit = [];
    public $usedToolIds = [];
    public $toolIds = [];
    public $uniqueToolIds = [];
    public $seenToolIds = [];
    public $deleteProgramId;


    public function OpenNewProgramModul()
    {
        $this->isOpenNewProgram = true;
    }

    public function CloseNewProgramModul()
    {
        $this->isOpenNewProgram = false;
    }

    public function openEditModal($id)
    {
        $editProgram = Program::findOrFail($id);
        $this->programId = $id;
        // dd($this->programId);
        $toolUsedEdit = UsedTool::where('program_id', $id)->get();
        $this->editName = $editProgram->name;
        $this->editProgram = $editProgram->program;
        $this->editNote = $editProgram->note;
        $this->usedTools = $toolUsedEdit;
        // dd($this->usedTools);
        $this->isEditOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditOpen = false;
    }

    public function getTools()
    {
        $this->tools = Tool::all();
    }

    public function openDeleteModal($id)
    {
        $this->deleteProgramId = $id;
        $this->isDeleteOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteOpen = false;
    }


    public function mount()
    {
        $this->getTools();
        $this->editName;
        $this->editProgram;
        $this->editNote;
        $this->usedTools;
        // $this->programId;
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



    public function update($programId)
    {
        $updateProgram = Program::findOrFail($programId);

        // Update the program fields
        $updateProgram->update([
            'name' => $this->editName,
            'program' => $this->editProgram,
            'note' => $this->editNote
        ]);

        foreach ($this->usedTools as $item) {
            if (is_object($item) && isset($item->tool_id)) {
                $toolId = $item->tool_id;
            } elseif (is_string($item)) {
                $toolId = intval($item);
            }

            // Check if $toolId has been seen before
            if (isset($seenToolIds[$toolId])) {
                // If seen before, unset it from $uniqueToolIds
                unset($uniqueToolIds[$seenToolIds[$toolId]]);
                unset($uniqueToolIds[$toolId]);
            } else {
                // Otherwise, add it to both arrays
                $uniqueToolIds[] = $toolId;
                $seenToolIds[$toolId] = count($uniqueToolIds) - 1;
            }
        }

        $this->toolIds = array_values($uniqueToolIds);
        UsedTool::where('program_id', $programId)->delete();

        // Check if any tools are selected before creating new associations
        if (!empty($this->toolIds)) {

            foreach ($this->toolIds as $toolId) {
                UsedTool::create([
                    'tool_id' => $toolId,
                    'program_id' => $programId
                ]);
            }
        }

        session()->flash('success', 'Program is successfully updated');
        $this->closeEditModal();
        $this->reset(['editName', 'editProgram', 'editNote', 'usedTools']);
    }

    public function delete($id)
    {
        // dd($id);
        $this->closeDeleteModal();
        Program::findOrFail($id)->delete();
        UsedTool::where('program_id', $id)->delete();
        session()->flash('success', 'Program is successfully deleted');
        $this->reset(['editName', 'editProgram', 'editNote', 'usedTools']);

    }

    public function render()
    {
        if(! $this->search){
            $this->programs = Program::all();
        }else{
            $this->programs = Program::where('name', 'like', '%'.$this->search.'%')
                                        ->orWhere('note', 'like', '%'.$this->search.'%')->get();
        }
        return view('livewire.programs-table',[
            'usedTools' => $this->usedTools
        ]);
    }
}
