<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associative Array</title>
</head> 
<body>
    
    <?php
        $product = [
            "name" => "Laptop",
            "price" => 45000,
            "stock" => 10
    ];

    
   foreach ($product as $key => $value) {
    echo $key . ": " . $value . "<br>";
}

    echo "<hr>";

    $students = [
    [
        "name"  => "Ana",
        "grade" => 85
    ],
    [
        "name"  => "Mark",
        "grade" => 72
    ]
];

foreach ($students as $student) {
    if ($student["grade"] >= 75) {
        echo $student["name"] . " - Passed<br>";
    } else {
        echo $student["name"] . " - Failed<br>";
    }
}

    ?>


   


</body>
</html>