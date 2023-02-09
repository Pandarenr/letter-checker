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
        return view('mainpage',['data'=>null,'history'=>$this->model->orderBy('id','desc')->get()]);
    }

    public function markString(Request $request)
    {
        $result = $this->model->getMarkedString($request);
        return view('mainpage',['data'=>$result,'history'=>$this->model->orderBy('id','desc')->get()]);
    }

    public function checkEdit(Request $request)
    {
        $result = $this->model->checkChangedString($request);
        return $result;
    }
}
