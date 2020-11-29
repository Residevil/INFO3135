<?php 
require_once 'Controllers/authController.php'; 


?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div>
        <a href="index.php"><button name="index" style="float: right;" class="btn btn-primary btn-lg">Homepage</button></a>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">
            <form action="login.php" method="post">
                <h3 class="text-center">Employee Login</h3>
                
                <?php if(count($errors) > 0) : ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">Username or Email:</label>
                    <input type="text" name="Username" value="<?php echo $Username; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="Password" class="form-control form-control-lg" required>
                </div>
                <div>
                    <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login</button>
                </div>
<p class="text-center">Not yet a member?<a href="registration.php">Register Now</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
