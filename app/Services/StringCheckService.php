<?php

namespace App\Services;

use App\Models\CheckedString;

class StringCheckService
{
    private $checkedString = null;
    private $langs = [
        'eng' => [
            'regex' => '/[a-zA-Z]/mu',
            'priority' => 2,
        ],
        'rus' => [
            'regex' => '/[а-яА-Я]/mu',
            'priority' => 1,
        ],
    ];

    public function __construct()
    {
        $this->checkedString = new CheckedString;
    }

    public function getMarkedString($string)
    {
        $lang = $this->checkLang($string);
        $markedString = $this->markLetters($string, $lang);
        $create = $this->checkedString->create(['string' => $string,'lang' => $lang,]);
        return [
            'string' => $string,
            'marked-string' => $markedString,
            'lang' => $lang,
        ];
    }

    public function checkChanges(string $string, string $lang)
    {
        $markedString = $this->markLetters($string, $lang);
        return ['markedString' => $markedString];
    }

    public function checkLang(string $string): string
    {
        $langs = $this->langs;
        $counts = [];
        foreach ($langs as $lang => $props) {
            $counts[$lang] = preg_match_all($props['regex'], $string);
        }
        arsort($counts);
        $duplicates = array_keys($counts, $counts[array_key_first($counts)]);
        if (count($duplicates) == 1) {
            return $duplicates[0];
        } else {
            $duplicates = array_flip($duplicates);
            foreach ($duplicates as $key => &$item) {
                $item = $langs[$key]['priority'];
            }
            asort($duplicates);
            return array_key_first($duplicates);
        }
    }

    public function markLetters(string $string, string $lang): string
    {
        $stringAsArr = mb_str_split($string);
        $langsForMark = $this->langs;
        unset($langsForMark[$lang]);
        foreach ($stringAsArr as &$letter){
            foreach ($langsForMark as $langProps) {
                if (preg_match($langProps['regex'], $letter)) {
                    $letter = '<span style="background-color:yellow;">' . $letter . '</span>';
                }
            }
        }
        return implode($stringAsArr);
    }
}