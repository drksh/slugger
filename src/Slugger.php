<?php

namespace JakobSteinn\Slugger;

/**
 * @author      Jakob Steinn <jstoone@drk.sh>
 * @license     MIT
 */
class Slugger {

    protected $characters = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',

        '-', '_', '.', '!', '~', '*', '\'', '(', ')',
    ];

    protected $incrementalBase;

    public function __construct() {
        $this->incrementalBase = count($this->characters);
    }

    public function encode($value) {
        $result = '';

        if($value == 0) {
            return $this->characters[0];
        }

        while($value > 0) {
            $result .= $this->characters[$value % $this->incrementalBase];

            $value = floor($value / $this->incrementalBase);
        }

        return $result;
    }

    public function decode($value) {
        $valueLength = count($value);
        $result = 0;

        for($currentCharacterIndex = 0; $currentCharacterIndex < $valueLength; $currentCharacterIndex++) {

            $currentCharacter = $value[$currentCharacterIndex];

            $currentCharacterValue = array_search($currentCharacter, $this->characters, true);

            $result += pow($this->incrementalBase, $valueLength - 1 - $currentCharacterIndex) * $currentCharacterValue;
        }

        return $result;
    }
}

