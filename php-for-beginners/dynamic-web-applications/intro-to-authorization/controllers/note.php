<?php
require 'Response.php';

$config = require 'config.php';
$db = new Database($config['database']);

$currentUserId = 1;

$note = $db->query('SELECT * from notes where id = :id', ['id' => $_GET['id']])->fetch();

if (! $note) {
    abort(Response::NOT_FOUND);
}

if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require 'views/note.view.php';

