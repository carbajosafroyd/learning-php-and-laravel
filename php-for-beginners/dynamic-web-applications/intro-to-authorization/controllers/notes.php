<?php
$config = require 'config.php';
$db = new Database($config['database']);


$notes = $db->query('SELECT * from notes where user_id = 1')->fetchAll();


require 'views/notes.view.php';

