<?php
session_start();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Transport Department</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <?php
    require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='" . $password . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            // Redirect user to index.php
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
    ?>
        <main class="form-signin w-80 m-auto">
            <div class="form">
                <form action="" method="post" name="login">
                    <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="uInput" placeholder="Username">
                        <label for="uInput">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <!-- <div class="form-check text-start my-3">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div> -->
                    <button class="btn btn-primary w-100 py-2" type="submit" name="submit" value="login">Sign in</button>
                </form>
            </div>
        <?php } ?>
        </main>
        <script src="js/bootstrap.bundle.min.js"></script>
</body>


</html>