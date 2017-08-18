<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

$db = new Database();
$db->createDb(); 
$db->createUsers(); 
$db->createPostTable();
$db->createCommentTable();


