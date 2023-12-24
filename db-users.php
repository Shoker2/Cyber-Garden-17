<?php

use Skema\Set;
use Skema\Field;

function db_connect()
{
    $servername = "localhost";
    $username = "zaskamilma";
    $password = "L36KF_TFBQYWSLk1";
    $database_name = "zaskamilma";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database_name);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    // mysqli_set_charset($conn, "utf8");

    return $conn;
}

function reg_user($login, $password)
{
    $conn = db_connect();

    $check_log = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "'");
    $numrows = mysqli_num_rows($check_log);

    if ($numrows != 0)
    {
        // user already exists
        $conn->close();
        return FALSE;
    } 
    else 
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`id`, `login`, `password`, `bookmarks`) VALUES (NULL, '" . $login . "', '" . $password . "', '{}');";

        if ($conn->query(($sql)) == TRUE) {
            $conn->close();
            return TRUE;
        } else {
            $conn->close();    
            echo $conn->error;
        }
    }
}

function update_password_user($login, $password, $new_password)
{    
    $conn = db_connect();

    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $result = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "'");

    $id_user = $result['id'];

    $sql = "UPDATE `users` SET `password` = '" . $new_password . "' WHERE `users`.`id` = ". $id_user;

    // return $conn->query(($sql));
    if  ($conn->query(($sql)) == TRUE) {
        $conn->close();
        return TRUE;
    } else {
        $conn->close();
        return False;
    }
}

function chech_login_password($login, $password) 
{
    $conn = db_connect();

    $result = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "'");
    $numrows = mysqli_num_rows($result);

    if ($numrows == 0) {
        // login wrong
        $conn->close();
        return False;
    }

    foreach ($result as $row) {
        $password_user = $row['password'];
    }

    if (!password_verify($password, $row["password"])) {
        // password wrong
        $conn->close();
        return False;
    }

    $conn->close();
    return True;
}

function read_bookmarks($login, $password)
{
    $conn = db_connect();

    if (chech_login_password($login, $password)) {
        $result = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "';");

        foreach ($result as $row) {
            $bookmarks_user = $row['bookmarks'];
        }

        if (strlen($bookmarks_user) == 0) {
            return array();
        }

        $conn->close();
        return explode(",", $bookmarks_user);
    }
    else {
        $conn->close();
        return FALSE;
    }
}

function add_bookmarks($login, $password, $new_bookmark) {
    $conn = db_connect();

    if (chech_login_password($login, $password)) {
        $result = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "';");

        foreach ($result as $row) {
            $bookmarks_user = $row['bookmarks'];
        }
        
        $result = "{$bookmarks_user},{$new_bookmark}";

        $sql = $conn->query("UPDATE `users` SET `bookmarks` = '" . $result . "' WHERE `users`.`login` = '" . $login . "'");
    }

    $conn->close();
    return explode(",", $bookmarks_user);
}

function remove_bookmarks($login, $password, $remove_bookmark) 
{
    $conn = db_connect();

    if (chech_login_password($login, $password)) {
        $result = $conn->query("SELECT * FROM `users` WHERE login='" . $login . "';");

        foreach ($result as $row) {
            $bookmarks_user = $row['bookmarks'];
        }
        
        $bookmarks_user = implode(',', array_diff(explode(",", $bookmarks_user), array($remove_bookmark)));
        $result = "{$bookmarks_user}";

        $sql = $conn->query("UPDATE `users` SET `bookmarks` = '" . $result . "' WHERE `users`.`login` = '" . $login . "'");
    }

    $conn->close();
    return explode(",", $bookmarks_user);
}

?>