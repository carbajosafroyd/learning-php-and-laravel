<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conditionals-and-booleans</title>

    <style>
        body{
            display: flex;
            place-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;

        }
    </style>
</head>


<body>
    <?php
        $name = "Froyd D. Carbajosa";
        $male = true;

        if($male){
            $message = "Male";
        }else{
            $message = "No gender indicated";
        }


    ?>


    <!-- <h1>I am <?php echo "$name  ($message)"?></h1> -->
     <h1>
     <?= "$name ($message)" ?>
    </h1>
</body>
</html>