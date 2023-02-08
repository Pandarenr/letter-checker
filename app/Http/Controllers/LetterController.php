<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;

class LetterController extends Controller
{

    private $model=null;

    public function __construct()
    {
        $this->model = new Letter;
    }

    public function mainPage()
    {
        return view('mainpage',['data'=>null]);
    }

    public function markString(Request $request)
    {
        $result = $this->model->getMarkedString($request);
        return view('mainpage',['data'=>$result]);
    }

    public function checkLetter(Request $request)
    {
        $result = $this->model->main($request);
        return $result;
    }
}
