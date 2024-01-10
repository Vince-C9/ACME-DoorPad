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
    public function isNotPalindrome(int $key): bool{
        /*
          Some loose thoughts that I've added here for discussion points.  I figured this approach would be clean,
          but probably against the spirit of the tech test!
         
          strrev is quite efficient and optimised, however relies on the number being cast as a string.
          We may wish to do this anyway given we're storing something that may contain leading 0's.
          Unless we start using multi-byte characters, it would probably fit fine here.  However if we did that, we'd
          likely want to extend this functionality anyway!  For the purpose of sportsmanship, see below.
         
          return $key !== strrev((string)$key);
         */

        $reversedKey = $this->reverseNumber($key);
        return $reversedKey !== $key;
    }


    /**
     * Uses Regex to determine whether there are 4 or more of the same digit in the provided key.
     *
     * @param int $key
     * @return bool
     */
    public function digitRepititionIsValid(int $key): bool{
        /*
            Per above, this can be achieved like this:

            $result = array_count_values(str_split($string));
            return max($result)>3;

            However in the spirit of things, here is an alternative:
         */


        /*
            Regex will match any character with the same text as the most recently matched and is greedy, so will match
            as many times as possible.
            Example: 111211:
            Finds 1, matches 1, matches 1, broken by 2.
            Finds 2, broken by 1.
            Finds 1, matches 1, end of string.
            Result:  [111,11]; (because 2 isn't duplicated in this example)
        */
        preg_match_all('/(.)\1+/', $key, $matches);
        $result = array_count_values(str_split($key));

        /*
            The result of array_count_values will be the sum of the repeat numbers.  In our case, 1=>5, 2=>1.
            We can be sure if the largest value is over 3, we have at least one duplicate character over 3.  We don't
            care if there is more than one! :)
        */
        return max($result)>3;
    }

    /**
     * Uses array maps and iterative loops to determine whether the key has a sequence of 4 or more and if so, determines
     * it as invalid.
     *
     * @param int $key
     * @return bool
     */
    public function digitSequenceIsValid(int $key): bool{
        /*
         * Convert key into an array of digits.  Was trying to avoid a foreach/array map but rather than clutter up with
         * 2 for loops, I thought I'd make the exception.  Shouldn't be an issue with 6 digit keys.
         */
        $digits = array_map('intval', str_split($key));

        //Set the previous digit to the first in the array.
        $previousDigit = $digits[0];

        //Set sequence length to 0
        $sequenceLength = 0;

        //Iterate digits and store the index.  Start at key 1 (we already have 0 stored)
        for($i=1; $i < count($digits); $i++)
        {
            /*
             * if the value stored in digits for the current iteration matches the previous digit plus 1, we are in
             * sequence.  Increment the sequence length, otherwise, reset it.
             */
            if ($digits[$i] === $previousDigit+1){
                $sequenceLength++;
            }else{
                $sequenceLength=0;
            }

            //If the sequence length is greater than 3, then we have hit our snag point.  Return false.
            if($sequenceLength>3){
                return false;
            }

            //Update the previousDigit to match the current digit so that it can be checked in the next iteration
            $previousDigit = $digits[$i];
        }

        //If we have no sequences of 4 or more, it is valid!  Return true.
        return true;
    }


    /**
     * Accepts an integer, then uses a while loop to reverse it.
     *
     * @param int $number
     * @return int
     */
    private function reverseNumber(int $number): int{
        $reversedNumber = 0;

        $count=0;
        while(floor($number) != 0){
            $count++;
            $digit = $number % 10; // find the 'unit' digit (right most digit) of number.
            $reversedNumber = ($reversedNumber * 10) + $digit; // push it to the right
            $number = $number / 10; // Remove the 'digit' from our number.
        }
        return $reversedNumber;
    }
}