<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> All Posts </title>
</head>

<body>


    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-3"  >
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
                <li class="nav-item active">
                    <a class="nav-link" href="./logout.php"> Log Out </a>
                </li>
            </ul>
        </div>
    </nav>





    <?php
    $sql = " SELECT * FROM posts INNER JOIN users on users.id = posts.post_created_by";
    $result = mysqli_query($connection, $sql);
    ?>

    <div class="container mt-5">

        <h1 class="mt-3 mb-3 text-center"> All Posts </h1>

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


        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> ID </th>
                    <th scope="col"> Title </th>
                    <th scope="col"> Description </th>
                    <th scope="col"> Created By </th>
                    <th scope="col"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                        <tr>
                            <th scope="row">
                                <?php echo $row['post_id']; ?>
                            </th>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php echo $row['description']; ?>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <a href="view.php?id=<?php echo $row['post_id']; ?>" type="button" class="btn btn-primary"> View </a>
                                <a href="update.php?id=<?php echo $row['post_id']; ?>" type="button" class="btn btn-success"> Update </a>
                                <a href="delete.php?id=<?php echo $row['post_id']; ?>" type="button" class="btn btn-danger"> Delete </a>
                            </td>
                        </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>

        <a href="create.php" type="button" class="btn btn-success mt-5"> Create Post </a>


    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>