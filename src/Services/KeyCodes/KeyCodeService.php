<?php

namespace Vince\AcmeDoorPad\Services\KeyCodes;

class KeyCodeService
{

    public function generateUniqueKey(){

    }

    /**
     * Accepts a key (number, for now, but should be simple enough to interface an extend) and reverses it, then compares
     * with the original to determine if it's a palindrome.
     *
     * @param $key
     * @return bool
     */
    public function isNotPalindrome($key): bool{
        /**
         * Some loose thoughts that I've added here for discussion points.  I figured this approach would be clean,
         * but probably against the spirit of the tech test!
         *
         * strrev is quite efficient and optimised, however relies on the number being cast as a string.
         * We may wish to do this anyway given we're storing something that may contain leading 0's.
         * Unless we start using multi-byte characters, it would probably fit fine here.  However if we did that, we'd
         * likely want to extend this functionality anyway!  For the purpose of sportsmanshi, see below.
         *
         * return $key !== strrev((string)$key);
         */

        $reversedKey = $this->reverseNumber($key);
        return $reversedKey !== $key;



    }

    public function digitRepititionIsValid($key){

    }

    public function digitSequenceIsValid($key){

    }


    private function reverseNumber($number){
        $digit = 0;
        $reversedNumber = 0;

        $count=0;
        while(floor($number) != 0){
            $count++;
            $digit = $number % 10; // find the 'unit' digit (right most digit) of number.
            $reversedNumber = ($reversedNumber * 10) + $digit; // push it to the right
            $number = $number / 10; // Remove the 'digit' from our number.

            if($count==6){

            }

        }
        return $reversedNumber;
    }
}