<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckedString;
use App\Services\StringCheckService;

class AppController extends Controller
{
    private $model = null;
    private $stringCheckService = null;

    public function __construct()
    {
        $this->model = new CheckedString;
        $this->stringCheckService = new StringCheckService;
    }

    public function mainPage()
    {
        return view('mainpage', ['data' => null,'history' => $this->model->orderBy('id','desc')->get()]);
    }

    public function markString(Request $request)
    {
        $validated = $request->validate(['string' => 'string|max:1000']);
        $string = $validated['string'];
        $data = $this->stringCheckService->getMarkedString($string);
        return view('mainpage', ['data' => $data, 'history'=>$this->model->orderBy('id','desc')->get()]);
    }

    public function checkEdit(Request $request)
    {
        $validated = $request->validate(['string' => 'string|max:1000', 'lang'=>'string|max:3']);
        $string = $validated['string'];
        $lang = $validated['lang'];
        $markedString = $this->stringCheckService->checkChanges($string, $lang);
        return $markedString;
    }
}