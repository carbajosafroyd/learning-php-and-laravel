<?php

require 'functions.php';
require 'Database.php';
// require 'router.php';

$config = require 'config.php'; 



$db = new Database($config['database']);
$post = $db->query("select * from post where id = 1")->fetch();




dd($post['title']);

