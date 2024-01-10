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

    public function digitRepititionIsValid($key){
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