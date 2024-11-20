<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}

// Post ID
$post_id = $_GET['id'];

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Post <?php echo $post_id; ?> </title>
</head>

<body>

    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-3">
            <img src="./Luffy Gear 5 .jpeg" class="rounded-circle" alt="LOGO" width="60px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php"> All Posts </a>
                </li>
            </ul>
        </div>
    </nav>






    <?php
    $sql = " SELECT * FROM posts INNER JOIN users on users.id = posts.post_created_by WHERE post_id = $post_id ";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    // echo "<pre>";
    // echo $id;
    // var_dump($result);
    // var_dump($row);
    // echo "</pre>";
    // die;
    ?>

    <div class="container mt-5">

        <!--                          Error or Success Messages    -->
        <!-- Success -->
        <?php
        if (isset($_SESSION['success'])):
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Error -->
        <?php
        if (isset($_SESSION['error'])):
        ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>


        <!--                         Post Details    -->
        <h1 class="mt-3 mb-3 text-center"> Post <?php echo $row['post_id'] ?> </h1>

        <div class="card">
            <div class="card-header">
                Post <?php echo $row['post_id']; ?> <br>
                Owner : <?php echo $row['name']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    Title : <?php echo $row['title']; ?>
                </h5>
                <p class="card-text">
                    <b>Description</b> : <?php echo $row['description']; ?>
                </p>
            </div>
        </div>


        <!--                    Make comment Section -->
        <form class="mt-5" action="./comment.php?post_id=<?php echo $post_id; ?>" method="post">
            <div class="form-floating mt-3">
                <textarea class="form-control" id="floatingTextarea" name="comment"></textarea>
                <label for="floatingTextarea">Comment:...</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3"> Comment </button>
        </form>


        <!-- All Comments -->
         <?php
            function show_comments( $connection, $post_id, $parent_id = NULL )
            {
                
                $sql = " SELECT * FROM comments WHERE post_id = '$post_id' AND parent_id " . ( $parent_id ? "= $parent_id" : "IS NULL") ;
                $comments = mysqli_query( $connection, $sql );

                if( mysqli_num_rows($comments) > 0 )
                {
                    
                    echo '<ul class="list-group">';

                        while( $comment = mysqli_fetch_assoc($comments) )
                        {
                            echo '<li class="list-group-item border-danger mt-1 ms-1">';
                                echo $comment['comment'];

                                
                                // Reply To Comment ?>
                                <form class="mt-1" action="reply.php?post_id=<?php echo $post_id; ?>&parent_id=<?php echo $comment['comment_id']; ?>" method="post">
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" id="floatingTextarea" name="comment"></textarea>
                                        <label for="floatingTextarea">Reply..</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3"> Reply </button>
                                </form>
                                

                                <?php
                                // Recursive call to display replies to the current comment
                                show_comments($connection, $post_id, $comment['comment_id']);

                            echo '</li>';
                        }

                    echo '</ul>';
                }

            }
         ?>

         <?php show_comments($connection, $post_id) ?>



    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>