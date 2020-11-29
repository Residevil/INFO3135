<?php 
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';

// verify the user using token
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    verifyEmail($token);
}

if(isset($_SESSION['Employee_id'])) {
    $edit = 'visible';
    $log = 'logout';
}
else {
    $_SESSION['username'] = '';
    $log = 'employee login';
}

if(isset($_POST['add'])) {
    header('location: add.php');
}

if(isset($_POST['edit_delete'])) {
    header('location: edit_delete.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
    <title>Homepage</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 form-div login">
            
            <?php if(isset($_SESSION['message'])) : ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif ?>

            <?php if(isset($_SESSION['update'])) : ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif ?>
            
            <h3> Welcome <?php echo $_SESSION['username']; ?></h3>

            <form action="index.php" method="post">
                <div>
                    <button name="edit_delete" style="float: right; visibility: <?php echo $edit; ?>;">Edit/Delete ticket</button>
                    <button name="add" style="float: right; visibility: <?php echo $edit; ?>;">Add ticket</button>          
                </div>
            </form>
  
            <a href="index.php?logout=1" class="logout"><?php echo $log; ?></a>
            
            <div class="alert alert-warning">
                Search for ticket by Violation Number or License Plate:
            </div>
                
            <form action="index.php" method="post">
                <div>
                    <input type="text" name="search" class="form-control form-control-lg">
                    <button type="search" name="search-btn">Search</button>
                </div>
            </form>
            <table id="ViolationTable" class="table table-striped" <?php echo $table; ?>>
                <th>
                    <tr>
                        <th>Violation Number</th>
                        <th>Violation Type</th>
                        <th>Violation Date</th>
                        <th>License Plate</th>
                        <th>Fine Amount</th>
                        <th>Fine Due Date</th>
                        <th></th>
                    </tr>
                </th>
                <?php if(!empty($table)) {
                    echo $output;
                } ?>
                <?php if((empty($hidden))) : ?>
                <tbody> 
                        <tr id="<?php echo $_SESSION['violation_id']; ?>">
                        <td><?php echo $_SESSION['violation_number']; ?></td>
                        <td><?php echo $_SESSION['violation_type']; ?></td>
                        <td><?php echo $_SESSION['violation_date']; ?></td> 		   
                        <td><?php echo $_SESSION['license_plate']; ?></td>   
                        <td><?php echo $_SESSION['fine_amount']; ?></td>   
                        <td><?php echo $_SESSION['fine_due_date']; ?></td>
                        <td><button type="submit" name="payment-btn">Pay</button></td>   
                        </tr>
                </tbody>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
