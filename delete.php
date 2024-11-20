<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}


$id = $_GET['id'];


$sql = " DELETE FROM posts WHERE post_id = '$id' ";
mysqli_query($connection, $sql);

header('location:index.php');
die;
