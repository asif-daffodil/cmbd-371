<?php 
 // array()

//  $myArr = ["Dhaka", "Rajshahi", "Khulna"];
$myArr = array("Dhaka", "Rajshahi", "Khulna");
echo $myArr[0];

echo "\n";

// is_array()
var_dump(is_array($myArr));

$name = "Asif";
var_dump(is_array($name));

// in_array()
var_dump(in_array("Dhaka", $myArr));
var_dump(in_array($name, $myArr));

// array_merge()
$otherCities = ["Khulna", "Dhaka", "Rongpur", "Dinajpur"];
$resultCities = array_merge($myArr, $otherCities);
print_r($resultCities);

// array_keys()
$mySkills = ["php" => 70, "nodejs" => 72, "mysql" => 50, "mongodb" => 60];
$keys = array_keys($mySkills);
print_r($keys);

// array_key_exists()
var_dump(array_key_exists("php", $keys));
var_dump(array_key_exists("php", $mySkills));

// array_shift()
array_shift($keys);
print_r($keys);

// array_unshift()
array_unshift($keys, "Laravel", "PHP");
print_r($keys);

// array_push()
array_push($keys, "Express.js", "Next.js");
print_r($keys);

// array_pop()
array_pop($keys);
print_r($keys);

// array_values()
$vals = array_values($mySkills);
print_r($vals);

// array_map()
$mapRes = array_map(fn ($n) =>  $n * $n, $vals);
print_r($mapRes);

// array_unique()
$uniqueCities = array_unique($resultCities);
print_r($uniqueCities);

// array_slice()
$sliceCities = array_slice($uniqueCities, 1, 3);
print_r($sliceCities);

// array_diff()
$diffCities = array_diff($uniqueCities, $sliceCities);
print_r($diffCities);

// array_search()
echo array_search("Dhaka", $diffCities) . "\n";

// array_reverse
$reverseCities = array_reverse($uniqueCities);
print_r($reverseCities);
?>