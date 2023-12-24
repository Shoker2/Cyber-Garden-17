<?php
require_once "../db-users.php";

$data = json_decode(file_get_contents("php://input"), true);

if (reg_user($data['login'], $data['password'])) {
    setcookie("login", $data['login']);
    setcookie("password", $data['password']);
    echo "OK";
} else {
    setcookie("login", "-");
    setcookie("password", "-");
    echo "NO";
}
?>