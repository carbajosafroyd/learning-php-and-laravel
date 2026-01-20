<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head> 
<body>
    
    <?php
        $progLang = ["Java", "PHP", "Javascript"];

        print_r($progLang);

        var_dump($progLang);

       var_dump($progLang[0]);
       var_dump($progLang[2]);
       
     



       foreach ($progLang as $proglang) {

       echo "<br>\nLanguage :" . $proglang . "\n";
       }

    ?>


   


</body>
</html>