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
            'purchaseUrl' => 'https/example.com',
        ],

        [
            'name' => 'Project Hail Mary',
            'author' => 'Andy Weir',
            'releaseYear' => '2021',
            'purchaseUrl' => 'https/example.com',
        ],

        [
            'name' => 'The Martian',
            'author' => 'Andy Weir',
            'releaseYear' => '2011',
            'purchaseUrl' => 'https/example.com',
        ],
    ];

    /*
        Exercise 2 — Custom filter() with callback

            Write a filter() function that:

            Accepts an array

            Accepts a callback

            Returns filtered items

            Then filter books by author = Andy Weir using a lambda.
        */
    function filter(array $items, callable $callback)
    {
        $filtered = [];

        foreach ($items as $item) {
            if ($callback($item)) {
                $filtered[] = $item;
            }
        }

        return $filtered;
    }

    $filteredBooks = filter($books, function ($book) {
        return $book['releaseYear'] < 2010;
    });




    ?>

    <ul>
        <?php foreach ($filteredBooks as $book) : ?>
            <li><?= $book['name'] ?></li>

        <?php endforeach; ?>
    </ul>



</body>

</html>