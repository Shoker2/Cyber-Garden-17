<?php
require_once "../db-users.php";

$data = json_decode(file_get_contents("php://input"), true);

// echo $data['id'];
echo remove_bookmarks($_COOKIE['login'], $_COOKIE['password'], $data['id']);
?>