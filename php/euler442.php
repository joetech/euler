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
 * Solution: After brute-forcing some numbers (see below) to find patterns, I recognized that :
 * Each power of 10 has an amount of non-eleven-free numbers equal to :
 * - the previous power of 10's amount times 10
 * - plus the previous actual power of 10
 * - minus the non-eleven-free amount from two powers of 10 back.
 *
 * Based on this, I created a script to take some base values and calculate the non-eleven free numbers in
 * 10^18.  However, we need the 10^18th eleven-free number, so I take my result and then brute force the
 * remaining number checks until I have 10^18 eleven-free numbers.
 */

// All powers of 11 (1600 seconds)
// 100 has 1 non-free numbers.
// 200 has 12 non-free numbers.
// 300 has 13 non-free numbers.
// 400 has 14 non-free numbers.
// 500 has 15 non-free numbers.
// 600 has 16 non-free numbers.
// 700 has 17 non-free numbers.
// 800 has 18 non-free numbers.
// 900 has 19 non-free numbers.
// 1000 has 20 non-free numbers.
// 2000 has 139 non-free numbers.
// 3000 has 159 non-free numbers.
// 4000 has 179 non-free numbers.
// 5000 has 199 non-free numbers.
// 6000 has 219 non-free numbers.
// 7000 has 239 non-free numbers.
// 8000 has 259 non-free numbers.
// 9000 has 279 non-free numbers.
// 10000 has 299 non-free numbers. (20 * 10 + 100 - 1)
// 20000 has 1578 non-free numbers. 1279 diff
// 30000 has 1877 non-free numbers. 299 diff
// 40000 has 2176 non-free numbers. 299 diff
// 50000 has 2475 non-free numbers. 299 diff
// 60000 has 2774 non-free numbers. 299 diff
// 70000 has 3073 non-free numbers. 299 diff
// 80000 has 3372 non-free numbers. 299 diff
// 90000 has 3671 non-free numbers. 299 diff
// 100000 has 3970 non-free numbers. 3671 diff from last power of 10 (lastP10 * 10 + 1000 - prevLastP10) (299 * 10 + 1000 -20)
// 200000 has 17641 non-free numbers.
// 300000 has 21611 non-free numbers.
// 400000 has 25581 non-free numbers.
// 500000 has 29551 non-free numbers.
// 600000 has 33521 non-free numbers.
// 700000 has 37491 non-free numbers.
// 800000 has 41461 non-free numbers.
// 900000 has 45431 non-free numbers.
// 1000000 has 49401 non-free numbers. 39700 + 10000 - 299 = 49401
// 2000000 has 194832 non-free numbers.
// 3000000 has 244233 non-free numbers.
// 4000000 has 293634 non-free numbers.
// 5000000 has 343035 non-free numbers.
// 6000000 has 392436 non-free numbers.
// 7000000 has 441837 non-free numbers.
// 8000000 has 491238 non-free numbers.
// 9000000 has 540639 non-free numbers.
// 10000000 has 590040 non-free numbers.

include "helper.php";

function powers()
{
    global $powers_of_e, $last;

    for ($i=$last+1; $i < $last + 18; $i++) {
        $powers_of_e[] = (string) pow(11, $i);
    }
}


$powers_of_e = array("11");
$last = 1;
// // $max = pow(10, 18);

powers();
// var_dump($powers_of_e);

// Calculate the number of non-free numbers for all powers of 11
$maxP10 = 18;
$p10 = 4;
$lastPrevCount = 20;
$prevCount = 299;

echo "Step 1 ---------\n";
for ($i=$p10; $i < $maxP10; $i++) {
    $count = ($prevCount * 10) + pow(10, $i - 1) - $lastPrevCount;
    echo "for " . pow(10, $i) . " count is $count\n";
    $lastPrevCount = $prevCount;
    $prevCount = $count;
}

$elFree = pow(10, 18) - $count;
echo "for " . pow(10, 5) . " there are $elFree is eleven-free numbers\n";

echo "Need to find $count more\n";

// But we need a few more, so now for a little grunt work.
echo "Step 2 ---------\n";



$i = pow(10, 18);
while ($elFree <= pow(10, 18)) {
    $isFree = true;
    foreach ($powers_of_e as $pow) {
        if (strstr((string) $i, (string) $pow)) {
            $isFree = false;
        }
    }
    if ($isFree) {
        $elFree++;
        echo "$elFree\n";
    }
    $i++;
}
$i -= 1;

var_dump($i);

result(1, 1);

