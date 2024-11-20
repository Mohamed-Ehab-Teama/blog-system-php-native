<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}

$sql = " SELECT * FROM users ";
$res = mysqli_query($connection, $sql);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Create Post</title>
</head>

<body>

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
            </ul>
        </div>
    </nav>




    <div class="container mt-5">

        <h1 class="m-5 text-center"> Create Post </h1>


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





        <form action="createHandle.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title">

            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="description">
            </div>

            <div class="mb-3">
                <label for="exa" class="form-label"> Created By </label>
                <select class="form-select" name="created_by" id="exa">
                    <?php
                    if (mysqli_num_rows($res) > 0):
                        while ($user = mysqli_fetch_assoc($res)):

                    ?>
                            <option value="<?php echo $user['id'] ?>"> <?php echo $user['name'] ?> </option>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>



            <button type="submit" class="btn btn-primary"> Create </button>
        </form>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>