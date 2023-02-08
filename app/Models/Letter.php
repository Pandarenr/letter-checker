<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Letter extends Model
{
    use HasFactory;

    public function getMarkedString(Request $request)
    {
        $validated = $request->validate(['string' => 'string|max:1000']);
        $string = $validated['string'];
        if($this->checkLang($string)=='rus'){
            $lettersPos=$this->getEngLetterPos($string);
        }else{
            $lettersPos=$this->getRusLetterPos($string);
        }
        $stringAsArray=$this->stringToArr($string);
        $markedString=[
            'string'=>$string,
            'marked-string'=>$this->markLetter($stringAsArray,$lettersPos),
        ];
        return $markedString;
    }

    public function stringToArr(string $string){
        $arr=[];
        for($i=0;$i<mb_strlen($string);$i++){
            $arr[]=mb_substr($string,$i,1);
        }
        return $arr;
    }

    public function checkLang(string $string)
    {
        $eng = $rus = 0;
        $eng=preg_match_all('/[a-z]/mu',$string); 
        $rus=preg_match_all('/[а-я]/mu',$string);
        if($rus>=$eng){
            return 'rus';
        }else{
            return 'eng';
        }
    }

    public function getEngLetterPos(string $string)
    {
        $lettersPos=[];
        for($i=0;$i<mb_strlen($string);$i++){
            if(preg_match("/[a-z]/mu",mb_substr($string,$i,1))){
                $lettersPos[]=$i;
            }
        }
        return $lettersPos;
    }

    public function getRusLetterPos(string $string)
    {
        $lettersPos=[];
        for($i=0;$i<mb_strlen($string);$i++){
            if(preg_match("/[а-я]/mu",mb_substr($string,$i,1))){
                $lettersPos[]=$i;
            }
        }
        return $lettersPos;
    }

    public function markLetter(array $stringArr,array $lettersPos){
        $markedString='';
        foreach($stringArr as $key => $letter){
            if(array_search($key,$lettersPos)!==false){
                $markedString=$markedString.'<span style="background-color:yellow;">'.$letter.'</span>';
            }else{
                $markedString=$markedString.$letter;
            }
        }
        return $markedString;
    }
}
