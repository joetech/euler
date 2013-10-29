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

    for ($i=$last+1; $i < $last + 100; $i++) {
        // $powers_of_e[] = 11 * $i;
        $powers_of_e[] = pow(11, $i);
    }
}

function eFree($num)
{
    global $powers_of_e;

    if ($num > $powers_of_e[count($powers_of_e)-1]) {
        powers();
    }

    foreach ($powers_of_e as $idx => $pow) {
        if ($pow > $num) {
            return true;
        }
        if (strstr((string) $num, (string) $pow)) {
            return false;
        }
    }

    return true;
}

function e($pos) {
    $x = 0;
    $num = 0;
    while ($x < $pos) {
        $num++;
        // echo "eFree($num) : " . (string) eFree($num) . "\n";
        if (eFree($num)) {
            $x++;
        }
    }

    return $num;
}

$powers_of_e = array(11);
$last = 1;

var_dump(e(pow(10, 18)));

result(1, 1);
