<?php 
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';


if(isset($_POST['edit'])) {
    $ViolationID = $_SESSION['ViolationID'];
    $ViolationNumber = $_POST['ViolationNumber'];
    $ViolationType = $_POST['ViolationType'];
    $ViolationDate = $_POST['ViolationDate'];
    $Violator = $_POST['Violator'];
    $LicensePlateNumber = $_POST['LicensePlateNumber'];
    $FineAmount = $_POST['FineAmount'];
    $FineDueDate = $_POST['FineDueDate'];
    

    $editTicket = "UPDATE Violations SET 
            ViolationNumber=?,
            ViolationDate=?,      
            FineAmount=?,      
            FineDueDate=?          
            WHERE ViolationID = ?";
    $stmt = $conn->prepare($editTicket);
    $stmt->bind_param('ssssi', $ViolationNumber, $ViolationDate, $FineAmount, $FineDueDate, $ViolationID);
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
                    <label for="ViolationNumber">Violation Number: </label>
                    <input type="text" name="ViolationNumber" value="<?php echo $_SESSION['ViolationNumber']; ?>" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="ViolationType">Violation type: </label>
                    <select name="ViolationType">
                        <option value=""></option>
                        <option value="Red Light"> Red Light </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ViolationDate">Violation_date: </label>
                    <input type="text" name="ViolationDate" placeholder="YYYY-MM-DD" value="<?php echo $_SESSION['ViolationDate']; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="Violator">Violator: </label>
                    <input type="text" name="Violator" value="<?php echo $_SESSION['Violator']; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="LicensePlateNumber">License Plate Number: </label>
                    <input type="text" name="LicensePlateNumber" placeholder="XXX-YYY" value=<?php echo $_SESSION['LicensePlateNumber'] ?> class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="FineAmount">Fine Amount: </label>
                    <input type="text" name="FineAmount" placeholder="e.g. 123.45" value="<?php echo $_SESSION['FineAmount']; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="FineDueDate">Fine Due Date:</label>
                    <input type="text" name="FineDueDate" placeholder="YYYY-MM-DD" value="<?php echo $_SESSION['FineDueDate']; ?>" class="form-control form-control-lg" required>
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
