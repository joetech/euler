<?php
/**
 * Problem: The function lcm(a,b) denotes the least common multiple of a and b.
 * Let A(n) be the average of the values of lcm(n,i) for 1≤i≤n.
 * E.g: A(2)=(2+2)/2=2 and A(10)=(10+10+30+20+10+30+70+40+90+10)/10=32.
 *
 * Let S(n)=∑A(k) for 1≤k≤n.
 * S(100)=122726.
 * Find S(99999999019) mod 999999017.
 *
 * Solution:
 */

include "helper.php";

function gcf($a, $b) {
    return ( $b == 0 ) ? ($a):( gcf($b, $a % $b) );
}

function lcm($a, $b) {
    return ( $a / gcf($a,$b) ) * $b;
}

function a($n)
{
    $total = 0;
    for ($i=1; $i <= $n ; $i++) {
        $numlcm = lcm($n, $i);
        $total += $numlcm;
    }

    return $total/$n;
}

// function a($n)
// {
//     global $last;

//     if ($n % 2 == 0) {
//         return pow($n/2, 2) + $last;
//     }
// }

function s($n)
{
    global $s;

    $idx = $n-1;
    if ($idx > 0) {
        $total = $s[$idx];
        $start = $idx + 1;
    } else {
        $total = 0;
        $start = 1;
    }

    for ($i=$start; $i <= $n ; $i++) {
        $total += a($i);
    }

    return $total;
}

$s = array();
$a = array();

// $x = 99999999019;
$x = 9999;
$last = 1;
for ($i=6; $i <= $x; $i*=6) {
    $num = a($i);
    echo "a($i) is " . $num . " (delta " . ($num - $last) . ")\n";
    $last = $num;
}

// $x = 1000;
// for ($n=1; $n <= $x; $n++) {
//     $tmp = array($n => s($n));
//     $s = $tmp;
//     echo "s($n) is " . $s[$n] . "\n";
// }

// result(8581146, $eightyNines);
result(1,1);
