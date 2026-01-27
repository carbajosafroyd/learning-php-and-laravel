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
        Exercise 5 — Thinking like Laravel

        Pretend you’re building a reusable system.

        Filter books that:

        Are written by Andy Weir

        AND released after 2015

        Use one lambda, clean and readable.
        */
    function filter($items, $fn)
    {
        $filtered = [];

        foreach ($items as $item) {
            if ($fn($item)) {
                $filtered[] = $item;
            }
        }

        return $filtered;
    };

    $filteredBooks = array_filter($books, function ($book) {
        return $book['author'] === 'Andy Weir' && $book['releaseYear'] > 2015;
    });




    ?>

    <ul>
        <?php foreach ($filteredBooks as $book) : ?>
            <li><?= $book['name'] ?></li>

        <?php endforeach; ?>
    </ul>



</body>

</html>