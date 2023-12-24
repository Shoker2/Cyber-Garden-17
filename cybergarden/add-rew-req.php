<?php
require_once "../db-attractions.php";

$data = json_decode(file_get_contents("php://input"), true);

add_reviews_by_id($data['id'], $_COOKIE['login'], $data['text'])
?>