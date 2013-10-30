<?php
/**
 * Problem: An integer is called eleven-free if its decimal expansion does not contain any substring representing a power of 11 except 1.
 *
 * For example, 2404 and 13431 are eleven-free, while 911 and 4121331 are not.
 *
 * Let E(n) be the nth positive eleven-free integer. For example, E(3) = 3, E(200) = 213 and E(500 000) = 531563.
 *
 * Find E(10^18).
 *
 * Solution: 
 */

include "helper.php";

function powers()
{
    global $powers_of_e, $last;

    for ($i=$last+1; $i < $last + 20; $i++) {
        $powers_of_e[] = pow(11, $i);
    }
}

function eFree()
{
    global $powers_of_e, $num;

    if ($num > $powers_of_e[count($powers_of_e)-1]) {
        powers();
    }
    foreach ($powers_of_e as $idx => $pow) {
        if ($pow > $num) {
            return true;
        }
        if (strstr((string) $num, (string) $pow)) {
            // $cnt = strlen($num) - 1;
            // Skip forward to avoid unneccessary checks
            // commented out for now as it produces incorrect results with very little speed gain.
            // if (strstr(substr((string) $num, 0, $cnt), (string) $pow)) {
            //     $new = (string) $pow + 1;
            //     $num = str_replace((string) $pow, $new, (string) $num);
            // }

            return false;
        }
    }

    return true;
}

function e($pos) {
    global $num;

    $x = 0;
    while ($x < $pos) {
        $num++;
        if (eFree()) {
            $x++;
        }
    }

    return $num;
}

$powers_of_e = array(11);
$last = 1;
$num = 0;

// var_dump(e(pow(10, 6))); // 5 =  1.8 sec ... 6 = 23 sec ... 7 = 288 sec
var_dump(e(500000)); // 10 seconds @ 500,000
// var_dump(e(pow(10, 18)));


result(1, 1);
