<?php

namespace Darkshare;

/**
 * A simple class for creating incremental slugs.
 *
 * @author      Jakob Steinn <jstoone@drk.sh>
 * @source      https://github.com/drksh/incremental-slugger
 * @license     MIT
 */
class Slugger {

    /**
     * The available URI-safe symbols
     *
     * @var string[]
     */
    protected $characters = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',

        '-', '_', '.', '!', '~', '*', '\'', '(', ')',
    ];

    /**
     * The zero-based radix.
     *
     * @var int
     */
    protected $incrementalBase;

    /**
     * Create a new Slugger.
     */
    public function __construct() {
        $this->incrementalBase = count($this->characters);
    }

    /**
     * Encode a given integer to a short slug.
     *
     * @param   int     $value
     * @return  string
     */
    public function encode(int $value): string {
        $result = '';

        if($value < 1) {
            throw new \InvalidArgumentException(
                'The given value has to be greater than zero. '.$value.' given.'
            );
        }

        if($value == 1) {
            return $this->characters[0];
        }

        $value -= 1;

        while($value > 0) {
            $result .= $this->characters[$value % $this->incrementalBase];

            $value = floor($value / $this->incrementalBase);
        }

        return $result;
    }

    /**
     * Decode a incremental slug.
     *
     * @param   string  $value
     * @return  int
     */
    public function decode(string $value): int {
        $valueLength = strlen($value);
        $result = 1;

        if($valueLength == 1) {
            $result += array_search($value, $this->characters, true);

            return $result;
        }

        for($currentCharacterIndex = 0; $currentCharacterIndex < $valueLength; $currentCharacterIndex++) {

            // It has proven to be faster to start with highest value first
            $currentCharacter = $value[$valueLength - $currentCharacterIndex - 1];

            $currentCharacterValue = array_search($currentCharacter, $this->characters, true);

            $characterResult = pow($this->incrementalBase, $valueLength - 1 - $currentCharacterIndex) * $currentCharacterValue;

            $result += $characterResult;
        }

        return $result;
    }
}

