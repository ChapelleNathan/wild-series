<?php

namespace App\Service;

class Slugify
{
    public function generate(string $input): string
    {
        $input = strtolower(str_replace(' ', '-', $input));
        $input = preg_replace('/[^A-Za-z0-9-]/', '', $input);
        return preg_replace('/-+/', '-', $input);
    }
}