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

// function d($k)
// {
// 	global $factors_of;

// 	$factors = array();

//     for ($i=$k; $i >= 1; $i--) {
// 		// if (array_key_exists($i, $factors_of)) {
// 		// 	$factors = array_merge($factors, $factors_of[$i]);
// 		// } else {
// 	        if ($k % $i == 0) {
// 	            $factors[] = $i;
// 	        }
// 		// }
//     }

//     $factors_of[$k] = array_unique($factors);

//     return $factors_of[$k];
// }

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
			// echo "sum is $sum\n";
		}
	}

	return $sum;
}

$factors_of = $sums = array();

// $tried = $hit = 0;
// for ($i=999; $i <= 400000; $i+=1000) {
// 	$d = d($i);
// 	if (substr($d, -3) == '864') {
// 		echo $i . " is " . $d . "\n";
// 		$hit++;
// 	}
// 	$tried++;
// }
// echo "$hit of $tried matched pattern.\n";

// echo "-------------------------\n";

// for ($i=1; $i <= 6; $i+=1) {
// 	$s = s(pow(10,$i));
// 	// if (substr($s, -3) == '000') {
// 		echo "s(10^" . $i . ") is " . $s . "\n";
// 	// }
// }

// for ($i=99; $i <= 200; $i+=10) {
// 	$s = s($i);
// 	// if (substr($s, -3) == '000') {
// 		echo $i . " is " . $s . "\n";
// 	// }
// }

echo s(pow(10,11)) % pow(10,9) . "\n";
// echo s(pow(10, 3)) . "\n";
// echo (pow(10, 9) * 215766508) % 563576517282 . "\n";


result(1,1);
// result(669171001, $total);
