<?php

include_once 'const.php';

if (isset($_GET['redirect']) && $_GET['redirect'] != "") {
    $slug = urldecode($_GET['redirect']);

    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $url = fetch_short_url($slug);
    $conn->close();
    header("location:" . $url);
    exit;
}

function fetch_short_url($slug)
{
    global $conn;
    $query = "SELECT * FROM short_url WHERE short_url = '" . addslashes($slug) . "' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'] + 1;
        $sql = "update short_url set count='" . $count . "' where id='" . $row['id'] . "' ";
        $conn->query($sql);
        return $row['url'];
    } else {
        die("Invalid Link!");
    }
}
