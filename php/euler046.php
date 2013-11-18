<?php
/**
 * Problem: It was proposed by Christian Goldbach that every odd composite number can be written as the sum of a prime and twice a square.
 *
 * 9 = 7 + 2×12
 * 15 = 7 + 2×22
 * 21 = 3 + 2×32
 * 25 = 7 + 2×32
 * 27 = 19 + 2×22
 * 33 = 31 + 2×12
 *
 * It turns out that the conjecture was false.
 *
 * What is the smallest odd composite that cannot be written as the sum of a prime and twice a square?
 *
 * Solution:
 */

include "helper.php";

$primes = array(2, 3, 5, 7);

function isPrime($num) {
    if ($num == 1) {
        return false;
    }

    if ($num == 2) {
        return true;
    }

    if ($num % 2 == 0) {
        return false;
    }

    for ($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2) {
        if($num % $i == 0)
            return false;
    }

    return true;
}

function getPrimes($howMany)
{
    global $primes;

    $x = 0;
    while ($x < $howMany) {
        $i = $primes[count($primes)-1];
        $isPrime = false;
        while (!$isPrime) {
            $i++;
            $isPrime = isPrime($i);
        }
        $primes[] = $i;
        $x++;
    }
}

function gbach($n)
{
    global $primes;

    foreach ($primes as $prime) {
        // if ($prime > $n) {
        //     return false;
        // }
        for ($i=1; $i < $n/4; $i++) {
            echo "Checking if $prime + 2 x $i^2 = $n\n";
            if ($prime + 2*pow($i,2) == $n) {
                return true;
            }
        }
    }

    return false;
}

getPrimes(50);

$holdsup = true;
$n = 3;
while ($holdsup) {
    $n += 2;

    if ($n > $primes[count($primes)-2]) {
        getPrimes(5);
    }

    $holdsup = gbach($n);
}

result(1, 1);
