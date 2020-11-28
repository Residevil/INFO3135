<?php 
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';


if(isset($_POST['edit'])) {
    $violation_id = $_SESSION['violation_id'];
    $violation_number = $_POST['violation_number'];
    $violation_type = $_POST['violation_type'];
    $violation_date = $_POST['violation_date'];
    $violator = $_POST['violator'];
    $license_plate = $_POST['license_plate'];
    $fine_amount = $_POST['fine_amount'];
    $fine_due_date = $_POST['fine_due_date'];
    

    $editTicket = "UPDATE violation SET 
            violation_number=?,
            violation_date=?,      
            fine_amount=?,      
            fine_due_date=?          
            WHERE violation_id = ?";
    $stmt = $conn->prepare($editTicket);
    $stmt->bind_param('ssssi', $violation_number, $violation_date, $fine_amount, $fine_due_date, $violation_id);
    $stmt->execute();
    $_SESSION['message'] = "Ticket is updated successfully.";
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
    <title>Register</title>
</head>
<body>
    <div>
        <a href="index.php"><button name="index" style="float: right;" class="btn btn-primary btn-lg">Homepage</button></a>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="edit.php" method="post">
                <h3 class="text-center">Edit ticket</h3>
                
                <?php if(count($errors) > 0) : ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="violation_number">Violation Number: </label>
                    <input type="text" name="violation_number" value="<?php echo $_SESSION['violation_number']; ?>" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="violation_type">Violation type: </label>
                    <select name="violation_type">
                        <option value=""></option>
                        <option value="Red Light"> Red Light </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="violation_date">Violation_date: </label>
                    <input type="text" name="violation_date" placeholder="YYYY-MM-DD" value="<?php echo $_SESSION['violation_date']; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="violator">violator: </label>
                    <input type="text" name="violator" value="<?php echo $_SESSION['violator']; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="license_plate">License Plate Number: </label>
                    <input type="text" name="license_plate" placeholder="XXX-YYY" value=<?php echo $_SESSION['license_plate'] ?> class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="fine_amount">Fine Amount: </label>
                    <input type="text" name="fine_amount" placeholder="e.g. 123.45" value="<?php echo $_SESSION['fine_amount']; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="fine_due_date">Fine Due Date:</label>
                    <input type="text" name="fine_due_date" placeholder="YYYY-MM-DD" value="<?php echo $_SESSION['fine_due_date']; ?>" class="form-control form-control-lg" required>
                </div>
                <div>
                    <button type="submit" name="edit" class="btn btn-primary btn-lg">Edit Ticket</button>
                    <button type="submit" onclick="history.back()" class="btn btn-primary btn-lg">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>