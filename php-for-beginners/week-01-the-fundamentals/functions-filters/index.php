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


        function filterByAuthor($books, $author) {
         $filteredBooks = [];
            foreach ($books as $book) {
                if ($book['author'] === $author) {
                $filteredBooks[] = $book;
            }
          }
        return $filteredBooks;
        }



    ?>

    <ul>
        <?php foreach (filterByAuthor($books, 'Andy Weir') as $book) : ?>

           
                <li><?= $book['name'] ?> (<?= $book['releaseYear'] ?>)</li>
            
        <?php endforeach; ?> 
    </ul>
    
    





</body>
</html>