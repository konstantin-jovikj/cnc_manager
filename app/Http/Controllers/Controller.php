<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Program;
use App\Models\UsedTool;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


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

    public function programs()
    {
        return view('pages.programs');
    }

    public function tools()
    {
        return view('pages.tools');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function view(Program $program)
    {
        $program = Program::with('tools', 'notes')->where('id', $program->id)->get();
        // dd($program);
        return view('pages.view-program', compact('program'));
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
}
