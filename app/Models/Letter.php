<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\StringCheckService;

class Letter extends Model
{
    use HasFactory;

    protected $fillable=[
        'string',
        'lang',
    ];

    public function checkChangedString(Request $request)
    {
        $validated = $request->validate(['string' => 'string|max:1000','lang'=>'string|max:3']);
        $string = $validated['string'];
        $lang=$validated['lang'];
        if($lang=='rus'){
            $lettersPos=$this->getEngLetterPos($string);
        }else{
            $lettersPos=$this->getRusLetterPos($string);
        }
        $stringAsArray=$this->stringToArr($string);
        $markedString=[
            'markedString'=>$this->markLetter($stringAsArray,$lettersPos),
        ];
        return $markedString;
    }
}