<?php
require_once './connection.php';

if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}


$post_id = $_GET['post_id'];
$parent_id = $_GET['parent_id'];
$user_id = $_SESSION['user_id'];
$reply = mysqli_real_escape_string( $connection, $_POST['comment']);



$sql = " INSERT INTO comments (post_id, comment, comment_created_by, parent_id) VALUES ('$post_id', '$reply', '$user_id', '$parent_id') ";
$result = mysqli_query($connection, $sql);


if ( $result )
{
    $_SESSION['success'] = " Updated Successfully  ";
    header('location:view.php?id='. $post_id );
    die;
}else{
    $_SESSION['error'] = " Something Went wrong ";
    header('location:view.php?id='. $post_id);
    die;
}