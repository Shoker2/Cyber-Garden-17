<?php
require_once "db-users.php";

function get_tag_name($id) {
    $conn = db_connect();

    $result = $conn->query("SELECT * FROM `attraction_tags` WHERE id='" . $id . "'");

    $conn->close();

    foreach ($result as $row) {
        return $row['name'];
    }

    return "";
}

function get_tag_list() {
    $conn = db_connect();

    $result = $conn->query("SELECT * FROM `attraction_tags`");

    $conn->close();

    $tags = array();
    foreach ($result as $row) {
        $tags[] = $row['id'];
    }

    return $tags;
}

function get_tag_id($name) {
    $conn = db_connect();

    $result = $conn->query("SELECT * FROM `attraction_tags` WHERE name='" . $name . "'");

    $conn->close();

    foreach ($result as $row) {
        return $row['id'];
    }

    return -1;
}

function get_attractions_id_by_tag_id($tag_ids)
{
    $conn = db_connect();

    $conditions = array();
    $count_atts = 0;

    foreach ($tag_ids as $id) {
        if (strlen($id) > 0) {
            $count_atts += 1;
            $conditions[] = "FIND_IN_SET('$id', tags) > 0";
        }
    }

    $sql = implode(' AND ', $conditions);

    if ($count_atts > 0) {
        $attractions = $conn->query("SELECT * FROM attractions WHERE " . $sql ." ORDER BY name ASC;");
    } else {
        $attractions = $conn->query("SELECT * FROM attractions ORDER BY name ASC;");
    }

    $result = array();
    foreach ($attractions as $row) {
        $result[] = $row['id'];
    }
    
    $conn->close();
    return $result;
}

function get_attraction_name_by_id($id)
{
    $conn = db_connect();

    $attractions = $conn->query("SELECT * FROM `attractions` WHERE id=" . $id . ";");

    $conn->close();

    foreach ($attractions as $row) {
        return $row['name'];
    }
    
    return "";
}

function get_attraction_img_by_id($id)
{
    $conn = db_connect();

    $attractions = $conn->query("SELECT * FROM `attractions` WHERE id=" . $id . ";");

    $conn->close();

    foreach ($attractions as $row) {
        return $row['img'];
    }
    
    return "";
}

function get_attraction_mapurl_by_id($id)
{
    $conn = db_connect();

    $attractions = $conn->query("SELECT * FROM `attractions` WHERE id=" . $id . ";");

    $conn->close();

    foreach ($attractions as $row) {
        return $row['map_url'];
    }
    
    return "";
}

?>