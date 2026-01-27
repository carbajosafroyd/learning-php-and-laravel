<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions and Filters</title>
</head>
<body>

    <?php

        $books = [
            [
                'name' => 'Do Androids Dream of Electric Sheep',
                'author' => 'Philip K. Dick',
                'releaseYear' => '1968',
                'purchaseUrl' => 'https/example.com'
            ],

            [
                'name' => 'Project Hail Mary',
                'author' => 'Andy Weir',
                'releaseYear' => '2021',
                'purchaseUrl' => 'https/example.com'
            ],

            [
                'name' => 'The Martian',
                'author' => 'Andy Weir',
                'releaseYear' => '2011',
                'purchaseUrl' => 'https/example.com'
            ],

        ];


        //Create a lambda that checks if a book was released after 2010.

        $isAfter2010 = function($books){
            return $books['releaseYear'] > 2010;
        };
        var_dump($isAfter2010($books[1]));

        echo $isAfter2010($books[0]);

    ?>

    



</body>
</html>