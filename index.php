<?php

include_once 'const.php';

if (isset($_GET['url']) && $_GET['url'] != "") {
    $url = urldecode($_GET['url']);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $conn = new mysqli($host, $user, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $slug = fetch_or_create_short_url($url);
        $conn->close();

        $href = $base_url . $slug;
        echo "<p><a target='_blank' href='$href'>$slug</a></p>";
        echo "<a href='$base_url'>Go Home</a>";
    } else {
        die("$url is not a valid URL");
    }
} else {
    $conn = new mysqli($host, $user, $password, $dbname);
    $shorts = [];
    $query = "SELECT * FROM short_url";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $shorts = mysqli_fetch_all ($result, MYSQLI_ASSOC);
    }

    include_once('home.php');
}

function fetch_or_create_short_url($url)
{
    global $conn;
    $query = "SELECT * FROM short_url WHERE url = '" . $url . "' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['short_url'];
    } else {
        $short_url = generate_short_url();
        $sql = "INSERT INTO short_url (url, short_url, count)
   VALUES ('" . $url . "', '" . $short_url . "', '0')";
        if ($conn->query($sql) === TRUE) {
            return $short_url;
        } else {
            die("Unknown Error Occured");
        }
    }
}

function generate_short_url()
{
    global $conn;
    $token = substr(md5(uniqid(rand(), true)), 0, 6);
    $query = "SELECT * FROM short_url WHERE short_url = '" . $token . "' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        generate_short_url();
    } else {
        return $token;
    }
}
