<?php

namespace Darkshare;

/**
 * A simple class for creating incremental slugs.
 *
 * @author      Jakob Steinn <jstoone@drk.sh>
 * @source      https://github.com/drksh/incremental-slugger
 * @license     MIT
 */
class Slugger
{
    /**
     * Sorted list of all 71 available URI-safe characters.
     *
     * @var string[]
     */
    private const CHARACTERS = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',

        '-', '_', '.', '!', '~', '*', '\'', '(', ')',
    ];

    /**
     * A radix derived from available slug characters.
     *
     * @var int
     */
    private const RADIX = 71;

    /**
     * Encode a given integer to a short slug.
     *
     * @param   int     $value
     * @return  string
     */
    public static function encode(int $value): string
    {
        $result = '';

        if ($value < 1) {
            throw new \InvalidArgumentException(
                'The given value has to be greater than zero. '.$value.' given.'
            );
        }

        if ($value == 1) {
            return static::CHARACTERS[0];
        }

        $value -= 1;

        while ($value > 0) {
            $result .= static::CHARACTERS[$value % static::RADIX];

            $value = floor($value / static::RADIX);
        }

        return $result;
    }

    /**
     * Decode an incremental slug.
     *
     * @param   string  $value
     * @return  int
     */
    public static function decode(string $value): int
    {
        $valueLength = strlen($value);
        $result = 1;

        if ($valueLength == 1) {
            $result += array_search($value, static::CHARACTERS, true);

            return $result;
        }

        for ($currentCharacterIndex = 0; $currentCharacterIndex < $valueLength; $currentCharacterIndex++) {

            // It has proven to be faster to start with highest value first
            $currentCharacter = $value[$valueLength - $currentCharacterIndex - 1];

            $currentCharacterValue = array_search($currentCharacter, static::CHARACTERS, true);

            $characterResult = pow(static::RADIX, $valueLength - 1 - $currentCharacterIndex) * $currentCharacterValue;

            $result += $characterResult;
        }

        return $result;
    }
}
