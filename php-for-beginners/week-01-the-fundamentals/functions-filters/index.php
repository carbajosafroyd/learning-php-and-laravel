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

    ?>

    <ul>
        <?php foreach ($books as $book) : ?>

            <li>
                <a href="<?= $booksp['purchaseUrl'] ?>">
                    <?= $book['name']?> (<?= $book['releaseYear'] ?>)
                </a> 
            </li>
        <?php endforeach; ?>
    </ul>
    
    





</body>
</html>