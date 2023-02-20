<?php

namespace App\Services;

class StringCheckService
{
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

    public function boot($string)
    {
        $lang = $this->checkLang($string);
        $positions = $this->lettersPos($string, $lang);
        $markedString = $this->markLetter($string, $positions);
        return [
            'string' => $string,
            'marked-string' => $markedString,
            'lang' => $lang,
        ];
    }

    public function checkChanges(string $string, string $lang)
    {
        $positions = $this->lettersPos($string, $lang);
        $markedString = $this->markLetter($string, $positions);
        return ['marked-string' => $markedString];
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

    public function lettersPos(string $string, string $lang): array
    {
        $langsForMark = $this->langs;
        unset($langsForMark[$lang]);
        $positions = [];
        foreach ($langsForMark as $lang => $props) {
            for ($i = 0; $i < mb_strlen($string); $i++) {
                if (preg_match($props['regex'], mb_substr($string, $i, 1))) {
                    $positions[] = $i;
                }
            }
        }
        return $positions;
    }

    public function markLetter(string $string, array $positions): string
    {
        $stringAsArr = mb_str_split($string);
        foreach ($positions as $position){
            $stringAsArr[$position] = '<span style="background-color:yellow;">' . $stringAsArr[$position] . '</span>';
        }
        return implode($stringAsArr);
    }
}