<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
