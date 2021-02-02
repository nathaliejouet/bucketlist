<?php

namespace App\Utile;

class Censurator
{

    const FORBIDDEN_WORD = ['chien', 'chat'];

    public function purify(string $text): string
    {
        $arr = explode(" ", $text);

        for ($i = 0; $i < count($arr); $i++) {
            if (in_array($arr[$i], self::FORBIDDEN_WORD)) {
                $arr[$i] = str_repeat("*", strlen($arr[$i]));
            }
        }

        return join(' ', $arr);
    }

}

