<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}

$title = $_POST['title'];
$description = $_POST['description'];
$created_by = $_POST['created_by'];
$id = $_GET['id'];


// If the fields is empty
if ( empty($title) )
{
    $_SESSION['error'] = "Title Cannot be Empty";
    header('location:create.php');
    die;
}
elseif ( empty($description) )
{
    $_SESSION['error'] = "Description Cannot be Empty";
    header('location:create.php');
    die;
}
elseif ( empty($created_by) )
{
    $_SESSION['error'] = "created_by Cannot be Empty";
    header('location:create.php');
    die;
}




// Insert the comment
$sql = " UPDATE posts SET title = '$title', description = '$description', post_created_by = '$created_by' WHERE post_id = '$id' ";
$result = mysqli_query($connection, $sql);


if ( $result )
{
    $_SESSION['success'] = " Updated Successfully  ";
    header('location:index.php');
    die;
}else{
    $_SESSION['error'] = " Something Went wrong ";
    header('location:index.php');
    die;
}