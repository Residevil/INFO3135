<?php require_once 'Controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div>
        <a href="index.php"><button name="index" style="float: right;" class="btn btn-primary btn-lg">Homepage</button></a>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="registration.php" method="post">
                <h3 class="text-center">Employee Registration</h3>
                
                <?php if(count($errors) > 0) : ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="employee type">Employee type: </label>
                    <select name="EmployeeType" placeholder="">
                        <option value=""></option>
                        <option value="Administrator"> Administrator </option>
                        <option value="Regular Employee"> Regular Employee </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="Address" value="<?php echo $Address; ?>" placeholder= "e.g. 9040 Lexile Rd"class="form-control form-control-lg" required>
                    <input type="text" name="City" value="<?php echo $City; ?>" placeholder="e.g. Toronto" class="form-control form-control-lg" required>
                    <select name="Province" placeholder="Select a Province or Territory">
                        <option value="">Select a Province</option>
                        <option value="AB"> Alberta </option>
                        <option value="BC"> British Columbia </option>
                        <option value="MB"> Manitoba </option>
                        <option value="NB"> New Brunswick </option>
                        <option value="NL"> Newfoundland and labrador </option>
                        <option value="NS"> Nova Scotia </option>
                        <option value="NT"> Northwest Territories </option>
                        <option value="NU"> Nunavut </option>
                        <option value="ON"> Ontario </option>
                        <option value="PE"> Prince Edward Island </option>
                        <option value="QC"> Quebec </option>
                        <option value="SK"> Saskatchewan </option>
                        <option value="YT"> Yukon </option>
                    </select>
                    <input type="text" name="PostalCode" value="<?php echo $PostalCode; ?>" placeholder="e.g. V9E 4C2" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" name="Username" value="<?php echo $Username; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="Email" value="<?php echo $Email; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="Password" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="passwordConf">Confirm Password: </label>
                    <input type="password" name="PasswordConf" class="form-control form-control-lg" required>
                </div>
                <div>
                    <button type="submit" name="register-btn" class="btn btn-primary btn-block btn-lg">Register</button>
                </div>
                <p class="text-center">Already a member?<a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
