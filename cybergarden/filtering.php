<?php
$data = json_decode(file_get_contents("php://input"), true);

$array = array();
foreach ($data as $datas) {
    foreach ($datas as $value) {
        $array[] = $value;
    }
}

$params = implode(',', $array);

print_r($params);

?>
