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
        return view('mainpage',['data'=>null,'history'=>$this->model->get()]);
    }

    public function markString(Request $request)
    {
        $result = $this->model->getMarkedString($request);
        return view('mainpage',['data'=>$result,'history'=>$this->model->get()]);
    }

    public function checkLetter(Request $request)
    {
        return dd($request);
        $result = $this->model->checkChangedString($request);
        return $result;
    }
}
