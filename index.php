<?php 
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username === "admin" && $password === "admin") {
        header('Location: dashboard.php');
    }
    else {
        $response = "Invalid Login Id & Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ELECTRO-TECH</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <h1 class="text-center login-title alert alert-info">Sign in to continue to Electro Tech India</h1>
                    <?php 
                    if(isset($response)) {
                        echo "<h3 class='alert alert-danger'>".$response."</h3>";
                    }
                    ?>
                    <div class="account-wall">
                        <img class="profile-img" src="images/login.png"
                             alt="">
                        <form class="form-signin" method="POST" action="index.php">
                            <input type="text" class="form-control" placeholder="Email" name = "username" required autofocus>
                            <input type="password" class="form-control" placeholder="Password" name = "password" required>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name = "login">
                                Sign in</button>
                            <label class="checkbox pull-left">
                                <input type="checkbox" value="remember-me">
                                Remember me
                            </label>
                            <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
