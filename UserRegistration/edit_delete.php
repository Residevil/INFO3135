<?php 
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';

if(isset($_SESSION['employee_id'])) {
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

if(isset($_POST['edit-btn'])) {
    header('location: edit.php');
}

if(isset($_POST['delete-btn'])) {
    $violation_id = $_SESSION['violation_id'];
    $delete = "DELETE FROM violation WHERE violation_id=?";
    $stmt=$conn->prepare($delete);
    $stmt->bind_param('i', $violation_id);
    $stmt->execute();
    $_SESSION['message'] = "Ticket is deleted successfully.";
    $_SESSION['alert-class'] = "alert-success";
    header('location: index.php');
    exit();
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
    <title>edit_delete violation</title>
</head>
<body>
    <div>
        <a href="index.php"><button name="index" style="float: right;" class="btn btn-primary btn-lg">Homepage</button></a>
    </div>
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
            
            <form action="edit_delete.php" method="post">
                <div>
                    <button name="add" style="float: right; visibility: <?php echo $edit; ?>;">Add ticket</button>          
                </div>
            </form>
  
            <a href="index.php?logout=1" class="logout"><?php echo $log; ?></a>
            
            <div class="alert alert-warning">
                Search for the ticket you wish to manage by its Violation Number or License Plate Number:
            </div>
                
            <form action="edit_delete.php" method="post">

                <div>
                    <input type="text" name="search" class="form-control form-control-lg">
                    <button type="search" name="search-btn">Search</button>
                </div>

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
                <?php if(empty($table)) : ?>
                <tbody> 
                        <tr id="<?php echo $_SESSION['violation_id']; ?>">
                        <td><?php echo $_SESSION['violation_number']; ?></td>
                        <td><?php echo $_SESSION['violation_type']; ?></td>
                        <td><?php echo $_SESSION['violation_date']; ?></td> 		   
                        <td><?php echo $_SESSION['license_plate']; ?></td>   
                        <td><?php echo $_SESSION['fine_amount']; ?></td>   
                        <td><?php echo $_SESSION['fine_due_date']; ?></td>
                        <td>
                            <button type="submit" name="edit-btn">Edit</button>
                            <button type="submit" name="delete-btn"  onclick="return confirm('Are you sure you want to delete this ticket?');"> Delete</button></td>   
                        </td>   
                        </tr>
                </tbody>
                <?php endif ?>
            </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>
