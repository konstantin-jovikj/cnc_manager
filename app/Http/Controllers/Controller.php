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
}
