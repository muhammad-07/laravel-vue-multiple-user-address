<?php
/*
        1
      1 2 C
    1 2 3 B D
      1 2 C
        1
*/
function pattern($n = 5) {
    $alphabet = range('A', 'Z'); // create an array of the alphabet

    // first outer loop to iterate through each row
    for ($i = 0; $i < (2 * $n - 1); $i++) {

        // assigning values to the comparator according to
        // the row number
        if ($i < $n) {
            $comp = 2 * ($n - $i) - 1;
        }
        else {
            $comp = 2 * ($i - $n + 1) + 1;
        }

        // first inner loop to print leading whitespaces
        for ($j = 0; $j < $comp; $j++) {
            print(" ");
        }

        // second inner loop to print number/alphabet
        for ($k = 0; $k < 2 * $n - $comp; $k++) {
            if ($k >= floor((2 * $n - $comp) / 2)) { // check if we are after the center digit
                $index = $k - floor((2 * $n - $comp) / 2); // calculate the index for the alphabet array
                if ($index < count($alphabet)) { // check if we still have letters left in the alphabet array
                    printf("%s ", $alphabet[$index]); // print the corresponding letter
                } else {
                    print(" "); // if we ran out of letters, print a space instead
                }
            } else {
                printf("%d ", $k + 10); // print the original digit
            }
        }
        print("\n");
    }
}
pattern(5);
