<?php
/**
 * Problem: Let d(k) be the sum of all divisors of k.
 * We define the function S(N) = ∑1≤i≤N ∑1≤j≤N^d(i·j).
 * For example, S(3) = d(1) + d(2) + d(3) + d(2) + d(4) + d(6) + d(3) + d(6) + d(9) = 59.
 *
 * You are given that S(10^3) = 563576517282 and S(10^5) mod 10^9 = 215766508.
 * Find S(10^11) mod 10^9.
 */

include "helper.php";

function d($k)
{
	$factors = array(1,$k);

	for ($i=2; $i <= $k/2; $i++) { 
		if (!in_array($i, $factors)) {
			if ($k % $i == 0) {
				$factors[] = $i;
				$factors[] = $k / $i;
			}
		} else {
			$i = $k;
		}
	}

	$factors = array_unique($factors);
	// echo "==========================\n";
	// echo "$k\n";
	// echo "------------------------\n";
	// var_dump($factors);
	return $factors;
}

function s($n)
{
	global $factors_of, $sums;

	$sum = 0;

	for ($i=1; $i <= $n; $i++) {
		for ($j=1; $j <= $n; $j++) {
			$num = $i * $j;
			if (isset($sums[$num])) {
				$sum += $sums[$num];
			} else {
				if (!isset($factors_of[$num])) {
					$factors_of[$num] = d($num);
				}
				$sums[$num] = array_sum($factors_of[$num]);
				$sum += $sums[$num];
			}
			// echo "sum $i and $j is $sum\n";
		}
	}

	return $sum;
}

$factors_of = $sums = array();



// echo s(pow(10,2));
// echo s(1) . "\n";;
// echo s(2) . "\n";;
// echo s(3) . "\n";;
// echo s(4) . "\n";;
// echo s(5) . "\n";;
// echo s(6) . "\n";;
// echo s(7) . "\n";;
// echo s(8) . "\n";;
// echo s(9) . "\n";;


// echo "s(800) is " . s(800) . "\n";

$divisor = 144;
for ($i=1; $i <= 300; $i++) {
    $sum = s($i);
    $next = $sum / $divisor;
    if ($sum % $divisor == 0) {
        echo "s(".$i.") is $sum ( / is $next)\n";
    }
}

// for ($i=1; $i <= 50; $i++) {
//     $d = d($i);
//     sort($d);
//     $txt = implode('.', $d);
//     echo "============= $i : $txt\n";
// }

//================================================================


result(1,1);
// result(669171001, $total);
