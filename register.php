<?php 
    require_once './connection.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Registeration </title>
</head>

<body>



    <div class="container mt-5">

        <h1 class="text-center m-3"> Registeration Page </h1>


        <!-- Success -->
        <?php
            if ( isset( $_SESSION['success'] ) ):
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
            if ( isset( $_SESSION['error'] ) ):
        ?>
        <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            ?>
        </div>
        <?php endif; ?>


        <form action="registerHandle.php" method="post">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="confirmPassword">
            </div>

            <button type="submit" class="btn btn-primary"> Create Account </button>

            <div class="mb-3 mt-3">
                Already have an account:
                <a href="./login.php"> Sign in </a>
            </div>

        </form>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>