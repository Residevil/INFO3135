<?php 
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';




if(isset($_POST['addticket-btn'])) {
    $ViolationNumber = $_POST['ViolationNumber'];
    $ViolationType = $_POST['ViolationType'];
    $ViolationDate = $_POST['ViolationFate'];
    $Violator = $_POST['Violator'];
    $DriverLicenseNumber = $_POST['DriverLicenseNumber'];
    $LicensePlateNumber = $_POST['LicensePlateNumber'];
    $VehicleName = $_POST['VehicleName'];
    $VehicleColour = $_POST['VehicleColour'];
    $VehicleType = $_POST['VehicleType'];
    $ManufacturerName = $_POST['ManufacturerName'];
    $FineAmount = $_POST['FineAmount'];
    $FineDueDate = $_POST['Fine_due_date'];

//grab violation type ID
    $Vioquery = "SELECT * FROM ViolationType WHERE Name = '". $ViolationType ."'";
    $result = $conn->query($Vioquery) or die($conn->error);
    while ($vtype = $result->fetch_array()) {
        $ViolationTYpeID = $vtype['ViolationTypeID'];
    }
    m,->close();

//grab violator ID
//Search violator table to check if input violator name is new or not
    $Vioquery = "SELECT * FROM Violators WHERE DriverLicenseNumber = '". $DriverLicenseNumber ."'";
    $result = $conn->query($Vioquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find violator in violator table
    // that means its a new violator, so add it into the violator table
    if($count == 0) {
        $addVio = "INSERT INTO Violators (DriverLicenseNumber, Name)
        VALUES (?, ?)";
        $stmt = $conn->prepare($addVio);
        $stmt->bind_param('ss', $DriverLicenseNumber, $Violator);
        $stmt->execute();
        $ViolatorID = $conn->insert_id;
        $stmt->close();
        $result->close();
    } else {
        while ($Vio = $result->fetch_array()) {
            $ViolatorID = $Vio['ViolatorID'];
        }
        $result->close();
    }

//grab manufacturer code
//Search vehicle_manufacturer table to check if input manufacturer name is new or not
    $Mquery = "SELECT * FROM vehicle_manufacturers WHERE name = '". $manufacturer_name ."'";
    $result = $conn->query($Mquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find manufacturer in manufacturer table
    // that means its a new manufacturer, so add it into the manufacturer table
    if($count == 0) {
        $addM = "INSERT INTO Manufacturers (name) VALUES (?)";
        $stmt = $conn->prepare($addM);
        $stmt->bind_param('s', $ManufacturerName);
        $stmt->execute();
        $ManufacturerCode = $conn->insert_id;
        $stmt->close();
        $result->close();
    } else {
        while ($M = $result->fetch_array()) {
            $ManufacturerCode = $M['ManufacturerCode'];
        }
        $result->close();
    }

//grab vehicle type ID
//Search vehicle_type table to check if input vehicle type name is new or not
    $VTquery = "SELECT * FROM VehicleType WHERE Name = '". $VehicleType ."' LIMIT 1";
    $result = $conn->query($VTquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find vehicle type in vehicle type table
    // that means its a new brand, so add it into the vehicle_type table
    if($count == 0) {
        $addVT = "INSERT INTO VehicleType (name) VALUES (?)";
        $stmt = $conn->prepare($addVT);
        $stmt->bind_param('s', $VehicleType);
        $stmt->execute();
        $VehicleTypeID = $conn->insert_id;
        $stmt->close();
        $result->close();
  
    } else {
        while ($VT = $result->fetch_array()) {
            $VehicleTypeID = $VT['VehicleTypeID'];
        }
        $result->close();
    }

    
//Search vehicle table to check if input license plate number is new or not
    $Vquery = "SELECT * FROM Vehicles WHERE LicensePlateNumber='". $LicensePlateNumber ."' LIMIT 1";
    $result = $conn->query($Vquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find license plate in vehicle table
    // that means its a new vehicle, so add it into the vehicle table
    if($count == 0) {
        $addV = "INSERT INTO VehicleS (LicensePlateNumber, Name, Colour, VehicleTypeID, ManufacturerCode)
        VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($addV);
        $stmt->bind_param('sssii', $LicensePlateNumber, $VehicleName, $VehicleColour, $VehicleTypeID, $ManufacturerCode);
        $stmt->execute();
        $stmt->close();
        $result->close();
    }


//Search violation table to check if the input violation number is new or not
    $query = "SELECT * FROM Violations WHERE ViolationNumber = '". $ViolationNumber ."' LIMIT 1";
    $result = $conn->query($query) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find the input violation number in the violation table
    // that means its a new violation number, so add it into the violation table
    if($count == 0) {
        $addTicket = "INSERT INTO Violations (ViolationNumber, ViolationDate, FineAmount, FineDueDate, ViolatorID, ViolationTypeID, LicensePlateNumber)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($addTicket) or die($conn->error);
        $stmt->bind_param("ssssiis", $ViolationNumber, $ViolationDate, $FineAmount, $FineDueDate, $ViolatorID, $ViolationTypeID, $LicensePlateNumber);
        $stmt->execute();
        $ViolationID = $conn->insert_id;
        $stmt->close();
        $result->close();

        //flash message
        $_SESSION['message'] = "Ticket is successfully added.";
        $_SESSION['alert-class'] = "alert-success";        
        //header('location: index.php');
        //exit();
    } else {
        $errors['ticket'] = "Ticket number already exists.";
        $result->close();
    }

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
            <form action="add.php" method="post">
                <h3 class="text-center">Add ticket</h3>
                
                <?php if(count($errors) > 0) : ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="ViolationNumber">Violation Number: </label>
                    <input type="text" name="ViolationNumber" value="<?php echo $ViolationNumber; ?>" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="ViolationType">Violation type: </label>
                    <select name="ViolationType" placeholder="">
                        <option value=""></option>
                        <option value="Red Light"> Red Light </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ViolationDate">Violation_date: </label>
                    <input type="text" name="ViolationDate" placeholder="YYYY-MM-DD" value="<?php echo $ViolationDate; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="V]iolator">violator: </label>
                    <input type="text" name="Violator" value="<?php echo $Violator; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="DriverLicense">Driver's License: </label>
                    <input type="text" name="DriverLicense" value="<?php echo $DriverLicense; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>
                
                <div class="form-group">
                    <label for="LicensePlateNumber">License Plate Number: </label>
                    <input type="text" name="LicensePlateNumber" value="<?php echo $LicensePlateNumber; ?>" placeholder="XXX-YYY" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="VehicleName">Vehicle Name: </label>
                    <input type="text" name="VehicleName" value="<?php echo $VehicleName; ?>" placeholder="" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_colour">Vehicle Colour: </label>
                    <input type="text" name="VehicleColour" value="<?php echo $VehicleColour; ?>" placeholder="" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="VehicleType">Vehicle Brand: </label>
                    <input type="text" name="VehicleType" value="<?php echo $VehicleType; ?>" placeholder="e.g. Audi" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="ManufactureName">Manufacturer: </label>
                    <input type="text" name="ManufacturerName" value="<?php echo $ManufacturerName; ?>" placeholder="e.g. Audi" class="form-control form-control-lg" required>
                </div>


                <div class="form-group">
                    <label for="FineAmount">Fine Amount: </label>
                    <input type="text" name="FineAmount" placeholder="e.g. 123.45" value="<?php echo $FineAmount; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="FineDueDate">Fine Due Date:</label>
                    <input type="text" name="FineDueDate" placeholder="YYYY-MM-DD" value="<?php echo $FineDueDate; ?>" class="form-control form-control-lg" required>
                </div>
                <div>
                    <button type="submit" name="addticket-btn" class="btn btn-primary btn-lg">Add Ticket</button>
                    <button type="submit" onclick="history.back()" class="btn btn-primary btn-lg">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
