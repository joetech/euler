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

// 11
// 121
// 1331
// 14641
// 161051
// 1771561
// 19487171
// 214358881
// 2357947691
// 25937424601
// 285311670611
// 3138428376721
// 34522712143931
// 379749833583241
// 4177248169415651
// 45949729863572161
// 505447028499293771
// 5559917313492231481

// ALL
// 200 = 13
// every addl hundred is 1 more
// 1000 = 149
// every addl 1000 is 20 more
// 10000 is 290
// 20000 is 1659
// 30000 is 1948
// 40000 is 2237
// 50000 is 2526

// Just 11
// 100   is 1
// 200   is 11
// 300   is 12
// 400   is 13
// 500   is 14
// 600   is 15
// 700   is 16
// 800   is 17
// 900   is 18
// 1000  is 19  (109 delta or 100 plus 9*1)
// 2000  is 128 (19 delta or the number from 1000)
// 3000  is 147 (19 delta)
// 4000  is 166 (19 delta)
// 5000  is 185 (19 delta)
// 6000  is 204 (19 delta)
// 7000  is 223 (19 delta)
// 8000  is 242 (19 delta)
// 9000  is 261 (19 delta)
// 10000 is 280 (19 delta)
// 20000 is 1451 (1171 delta or 1000 plus 9*19)
// 30000 is 1731 (280 delta or the number from 10000)
// 40000 is 2011 (280 delta)
// 50000 is 2291 (280 delta)
// 60000 is 2571 (280 delta)
// 70000 is 2851 (280 delta)
// 80000 is 3131 (280 delta)
// 90000 is 3411 (280 delta)
// 100000 is 3691 (280 delta)

include "helper.php";

function powers()
{
    global $powers_of_e, $last;

    for ($i=$last+1; $i < $last + 18; $i++) {
        $powers_of_e[] = (string) pow(11, $i);
    }
}


$powers_of_e = array("121");
$last = 1;
$max = 200;
// $max = pow(10, 18);

// powers();

// Real stuff

$max = 6;

$count = $prev = 1;
for ($i=1; $i < $max; $i++) {
    if ($i > 2) {
        $addl = $prev * 9;
    } else {
        $addl = 0;
    }
    $count = $count * 9 + pow(10, $i) + $addl;
    echo "for " . pow(10, $i+2) . " count is $count\n";
}
var_dump($count);

die();





// tester
$testers = array(
    100,
    200,
    300,
    400,
    500,
    600,
    700,
    800,
    900,
    1000,
    2000,
    3000,
    4000,
    5000,
    6000,
    7000,
    8000,
    9000,
    10000,
    20000,
    30000,
    40000,
    50000,
    60000,
    70000,
    80000,
    90000,
    100000,
    200000,
    300000,
    400000,
    500000,
    600000,
    700000,
    800000,
    900000,
    1000000
    );
foreach ($testers as $max) {
    $count = 0;
    for ($i=1; $i < $max; $i++) {
        if (strstr((string) $i, (string) $powers_of_e[0])) {
            $count++;
        }
    }
    echo "$max has $count non-free in it.\n";
}

result(1, 1);

