<?php

namespace App\Utile;

class Censurator
{

    public function purify(string $text): string
    {
        $file = explode(';', file_get_contents('badwords.csv', FILE_USE_INCLUDE_PATH));
        $arr = explode(" ", $text);
        for ($i = 0; $i < count($arr); $i++) {
            if (in_array($arr[$i], $file)) {
                $arr[$i] = str_repeat("*", mb_strlen($arr[$i]));
            }
        }
        return join(' ', $arr);
    }

}

