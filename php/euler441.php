<?php
/**
 * Problem: For an integer M, we define R(M) as the sum of 1/(p·q) for all the integer pairs p and q which satisfy all of these conditions:
 * 
 * 1 ≤ p < q ≤ M
 * p + q ≥ M
 * p and q are coprime.
 * We also define S(N) as the sum of R(i) for 2 ≤ i ≤ N.
 * We can verify that S(2) = R(2) = 1/2, S(10) ≈ 6.9147 and S(100) ≈ 58.2962.
 * 
 * Find S(10^7). Give your answer rounded to four decimal places.
 */

include "helper.php";

// function gcd($a, $b)
// {
// 	$a = abs($a);
// 	$b = abs($b);

// 	if ($a == 0) {
// 		return $b;
// 	} elseif ($b == 0) {
// 		return $a;
// 	} elseif ($a > $b) {
// 		return gcd($b, $a % $b);
// 	} else {
// 		return gcd($a, $b % $a);
// 	}
// }

function gcd($b, $a) {
	$c = 1;

	do {
		$c = $a % $b;
		$gcd = $b;
		$a = $b;
		$b = $c;
	}
	while ($c != 0);

	return $gcd;
}

function r($m, $tots)
{
	if (isset($tots[$m-1])) {
		$a = $m;
		$b = 1;
	} else {
		$a = 2;
		$b = 1;
	}
	$pairs = array();
	for ($q=$a; $q <= $m; $q++) {
		for ($p=$b; $p < $q; $p++) {
			if ($p + $q >= $m && gcd($p, $q) == 1) {
				$val = (string) (1/($p*$q));
				$pairs[] = $val;
			}
		}
	}

	$total = round(array_sum($pairs), 4);
	return $total;
}

function s($n)
{
	$tots = array();
	$total = 0;

	for ($i=2; $i <= $n; $i++) {
		$tots[$i] = r($i, $tots);
		if (isset($tots[3])) {
			$total += $tots[2] + $tots[$i];
		} else {
			$total += $tots[$i];
		}
		echo "r($i)\n";
	}

	return round($total, 4);
}

echo s(2000) . "\n"; // 58.2962
// echo r(pow(10,3), array()) . "\n";
// echo s(pow(10, 3.5)) . "\n";

// echo gcd(100335436546545465, 38545454545646548) . "\n";

// echo s(pow(10,11)) % pow(10,9) . "\n";
// echo (pow(10, 9) * 215766508) % 563576517282 . "\n";

result(1,1);
// result(669171001, $total);
