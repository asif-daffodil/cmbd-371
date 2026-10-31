<?php 

// i. Find maximum number from an array
$numbers = [10, 30, 40, 20, 50];
echo max($numbers)."\n";

// ii. Find 2nd max number from an array
rsort($numbers);
echo ($numbers[1])."\n";

// iii. Sort array from min to max
sort($numbers);
print_r($numbers);

// iv. Calculate average number of an array
$average = array_sum($numbers) / count($numbers);
echo $average ."\n";

// v. Merging 2 different types of array together
$name = ["Riad","Tamim","Asif"];
$mergeing = array_merge($numbers, $name);
print_r($mergeing);

// vi. Search data from an array
$search = in_array("Riad",$name);
var_dump($search);

// vii. Show array data in lowercase and uppercase
foreach ($name as  $value) {
    echo strtoupper($value).", ";
}
echo "\n";
foreach ($name as  $value) {
    echo strtolower($value).", ";
}

// viii. Get unique values
$roll = [10, 20, 20, 10, 30, 40];
$uniqueArr = array_unique($roll);
print_r($uniqueArr);


// ix. Remove duplicate values

$cities = ["Dhaka","Khulna","Rajshahi","Khulna","Sherpur","Dhaka"];
$duplicateVal = array_values(array_unique($cities));
print_r($duplicateVal);

// x. Check if email address is unique
$emails = ["riad@mail.com", "tamim@mail.com", "asif@mail.com"];
$newEmail = "riad@mail.com";
$isUnique = !in_array($newEmail, $emails);
var_dump($isUnique); 

// xi. Check unique username
$usernames = ["riad", "tamim", "asif"];
$newUsername = "shahin";
$isUnique = !in_array($newUsername, $usernames);
var_dump($isUnique);


// xii. Merge 2 comma separated lists with unique value only
$cities1 = "Dhaka, Khulna, Rajshahi";
$cities2 = "Dhaka, Sherpur, Khulna";

$arr1 = explode(", ", $cities1);
$arr2 = explode(", ", $cities2);

$merge = array_merge($arr1,$arr2);
$unique = array_values(array_unique($merge));
print_r($unique);

// xiii. Difference between 2 multi-dimensional arrays
$array1 = [
    ["name" => "Riad", "age" => 20],
    ["name" => "Tamim", "age" => 22]
];
$array2 = [
    ["name" => "Riad", "age" => 20],
    ["name" => "Asif", "age" => 25]
];

$difference = [];

foreach ($array1 as $value) {
    if(!in_array($value, $array2)){
        $difference[] = $value;
    }
}
print_r($difference);

// xiv. Check if all values are string or not

$name = ["Riad","Tamim","Shahin","Asif"];

$allString = true;


foreach ($name as $value) {
    if (!is_string($value)) {
        $allString = false;
    }
}
var_dump($allString);

// xv. Union of 2 arrays
$countrys1 = ["Bangladesh","India","Pakisthan"];
$countrys2 = ["America","Bangladesh","India"];

$mergeCountry = array_merge($countrys1,$countrys2);
$union = array_values(array_unique($mergeCountry));
print_r($union);

// xvi. Filter out array data with some specific keys

$person = [
    "name" => "Riad",
    "age" => 20,
    "city" => "Sherpur"
];

$keys = ["name","city"];
$result = array_intersect_key($person,array_flip($keys));
print_r($result);

// xvii. Filter a multi-dimensional array
$students = [
    ["name" => "Riad", "age" => 20],
    ["name" => "Tamim", "age" => 17],
    ["name" => "Asif", "age" => 22]

];
$filter = array_filter($students, function ($student) {
    return $student["age"] >= 18;
});
print_r($filter);


// xviii. Remove all white spaces from an array

$name = ["Riad Sorker","Tamim Ahmed","Asif Abir"];
// foreach ($name as $value) {
//     echo str_replace(" ","",$value)."\n";
// }
$cleaned = array_map(fn($n) => str_replace(" ","", $n),$name);
print_r($cleaned);

// xix. Combine 2 array and use one array data as keys and others as values
$key = ["name","city","age"];
$values = ["Riad","Sherpur",20];

$combine = array_combine($key,$values);
print_r($combine);

// xx. Convert string to array
$string = "Riad,Tamim,Shain,Asif";
$array = explode(",",$string);
print_r($array);



 ?>