<?php
// indexed array
$skills = ["HTML", "CSS", "Bootstrap", "TailwindCSS", "JS", "jQuery", "PHP", "OOP", "MySQL"];
print_r($skills);
echo $skills[0];
for ($i=0; $i < count($skills); $i++) { 
    echo $skills[$i]."\n";
}
foreach ($skills as $value) {
    echo $value . "\n";
};

// accosiative array
$myInfo = ["name" => "Asif Abir", "gender" => "Male", "city" => "Dhaka", "ocupation" => "Web Developer"];
print_r($myInfo);
echo $myInfo["name"];
foreach ($myInfo as $key => $val) {
    echo ucfirst($key) . " : " . $val . "\n";
}

// Multidimontional array
$myStudentInfo = [
    ["Riad", "Sherpur"],
    ["Tamim", "Madaripur"],
    ["Shahin", "Jamalpur"],
    ["Asif", "Dhaka"]
];
print_r($myStudentInfo);
echo $myStudentInfo[1][0];

for ($i=0; $i < count($myStudentInfo); $i++) { 
    for ($j=0; $j < count($myStudentInfo[$i]); $j++) { 
            echo $myStudentInfo[$i][$j].($j == 0 ? ", ":".");
    }
    echo "\n";
}

foreach ($myStudentInfo as $vals) {
    foreach ($vals as $k => $val) {
        echo $val.($k == 0 ? ", ":".");
    }
    echo "\n";
}

$myStudentInfo2 = [
    "std1" => ["name" => "Riad", "city" => "Sherpur"],
    "std2" => ["name" => "Tamim", "city" => "Madaripur"],
    "std3" => ["name" => "Shahin", "city" => "Jamalpur"],
    "std4" => ["name" => "Asif", "city" => "Dhaka"]
];
// print_r($myStudentInfo2);
// echo $myStudentInfo2["std1"]["name"];

foreach($myStudentInfo2 as $keys => $vals) {
    foreach($vals as $k => $v) {
        echo ucfirst($k)." : ".$v.", ";
    }
    echo "\n";
}
