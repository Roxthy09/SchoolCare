<?php

namespace App\Services;

class BadWordFilter
{
    protected static array $badWords = [
        'anjing', 'bangsat', 'babi', 'bajingan', 'goblok',
        'tolol', 'idiot', 'bodoh', 'kampret', 'keparat',
        'kontol', 'memek', 'ngentot', 'brengsek', 'sialan',
        'asu', 'jancok', 'dancok', 'cok', 'jangkrik',
        'celeng', 'monyet', 'bedebah', 'setan', 'iblis',
    ];

    public static function contains(string $text): bool
    {
        $text = strtolower($text);
        foreach (self::$badWords as $word) {
            if (str_contains($text, strtolower($word))) {
                return true;
            }
        }
        return false;
    }

    public static function clean(string $text): string
    {
        foreach (self::$badWords as $word) {
            $replacement = str_repeat('*', strlen($word));
            $text = str_ireplace($word, $replacement, $text);
        }
        return $text;
    }
}