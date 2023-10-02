<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Tool;
use App\Models\Program;
use Livewire\Component;
use App\Models\UsedTool;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;

class ProgramsTable extends Component
{

    use Actions;

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
    public $dimension = '';

    public $programId;
    public $noteId;
    public $editName;
    public $editProgram;
    public $editDimension;
    public $editNotes = [];

    public $usedTools = [];
    public $toolUsedEdit = [];
    public $usedToolIds = [];
    public $toolIds = [];
    public $uniqueToolIds = [];
    public $seenToolIds = [];
    public $deleteProgramId;


    public $isEditNoteOpen = 0;

    public function OpenEditNoteNodal($id)
    {
        // dd($id);
        $note = Note::findOrFail($id);
        $this->noteId = $id;
        $this->note = $note->note;
        $this->isEditNoteOpen = true;
        // dd($note);
    }


    public function updateNote($noteId)
    {
        // dd($noteId);
        $updateNote = Note::findOrFail($noteId);
        // Update the note field
        $updateNote->update([
            'note' => $this->note,
        ]);

        session()->flash('success', 'Note is successfully updated');
        $this->reset(['note']);
        $this->CloseEditNoteModal();
        $this->openEditModal($this->programId);
    }

    public function CloseEditNoteModal()
    {
        $this->isEditNoteOpen = false;
    }


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

        $toolUsedEdit = UsedTool::where('program_id', $id)->get();
        $this->editName = $editProgram->name;
        $this->editProgram = $editProgram->program;
        $this->editDimension = $editProgram->dimension;

        $programNotes = Note::where('program_id', $id)->get();

        $this->editNotes = $programNotes;
        $this->usedTools = $toolUsedEdit;

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
        $this->editNotes;
        $this->usedTools;

        // $this->programId;
    }

    public function saveProgram()
    {
        $program = Program::create([
            'name' => $this->name,
            'program' => $this->program,
            'dimension' => $this->dimension
        ]);

        $program->save();

        $lastRow = $program->id;

        $note = Note::create([
            'program_id' => $lastRow,
            'note' => $this->note
        ]);

        $note->save();

        $nrOfTools = 0;

        if ($this->toolUsed != NULL){
            $nrOfTools = count($this->toolUsed);

            $i=0;
            for($i==0;$i<$nrOfTools; $i++){
                $newUsedTool = UsedTool::create([
                    'tool_id' => $this->toolUsed[$i],
                    'program_id' => $lastRow
                ]);
                $newUsedTool->save();
            }
        }


        session()->flash('success', 'New Program saved successfully.');
        $this->CloseNewProgramModul();
        $this->reset('name', 'program', 'note', 'dimension');
    }



    public function update($programId)
    {
        $updateProgram = Program::findOrFail($programId);

        // Update the program fields
        $updateProgram->update([
            'name' => $this->editName,
            'program' => $this->editProgram,
            'dimension' => $this->editDimension
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
        $this->reset(['editName', 'editProgram', 'usedTools']);
    }

    public function delete($id)
    {
        // dd($id);
        $this->closeDeleteModal();
        Program::findOrFail($id)->delete();
        UsedTool::where('program_id', $id)->delete();
        // session()->flash('success', 'Program is successfully deleted');
        $this->notification()->success('Deleted');
        $this->reset(['editName', 'editProgram', 'usedTools', 'editDimension']);

    }


    public function addNote($id)
    {
        $note = Note::create([
            'program_id' => $id,
            'note' => $this->note,
        ]);

        $note->save();
        $this->reset('note');
        $this->closeEditModal();
        $this->openEditModal($id);

    }

    public function deleteNote($id)
    {
        Note::where('id', $id)->delete();
        // $this->closeEditModal();
        // $this->mount();
        session()->flash('success', 'Note is successfully deleted');
        return redirect()->route('programs');

    }



    public function render()
    {
        if(! $this->search){
            $this->programs = Program::all();
        }else{
            $this->programs = Program::where('name', 'like', '%'.$this->search.'%')->get();
        }
        return view('livewire.programs-table',[
            'usedTools' => $this->usedTools
        ]);
    }
}
