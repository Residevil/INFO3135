<?php 
require_once 'Controllers/authController.php'; 
require_once 'config/db.php';

// verify the user using token
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    verifyEmail($token);
}

if(!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">
            
            <?php if(isset($_SESSION['message'])) : ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif ?>
            
            <h3> Welcome, <?php echo $_SESSION['username']; ?> ! </h3>
            
            <a href="index.php?logout=1" class="logout">Logout</a>
            
            <?php if(!$_SESSION['verified']) : ?>
            <div class="alert alert-warning">
                You need to verify your <strong><?php echo $_SESSION['usertype']; ?></strong> account.
                Sign in to your email account and click on the
                verification link we just emailed you at
                <strong><?php echo $_SESSION['email']; ?></strong>
            </div>
            <?php endif ?>
            
            <?php if($_SESSION['verified']) : ?>
                <button class="btn btn-block btn-lg btn-primary">I am verified!</button>
            <?php endif ?>
                
            <form action="index.php" method="get">
                <div>
                    <input type="text" name="search" class="form-control form-control-lg">
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>