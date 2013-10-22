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
	global $d_set;
}

$d_set = array();



// echo s(pow(10,11)) % pow(10,9) . "\n";
// echo (pow(10, 9) * 215766508) % 563576517282 . "\n";

result(1,1);
// result(669171001, $total);
