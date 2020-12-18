<?php 
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';




if(isset($_POST['addticket-btn'])) {
    $violation_number = $_POST['violation_number'];
    $violation_type = $_POST['violation_type'];
    $violation_date = $_POST['violation_date'];
    $violator = $_POST['violator'];
    $driver_license = $_POST['driver_license'];
    $license_plate = $_POST['license_plate'];
    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_colour = $_POST['vehicle_colour'];
    $vehicle_type = $_POST['vehicle_type'];
    $manufacturer_name = $_POST['manufacturer_name'];
    $fine_amount = $_POST['fine_amount'];
    $fine_due_date = $_POST['fine_due_date'];

//grab violation type ID
    $Vioquery = "SELECT * FROM violation_type WHERE name = '". $violation_type ."'";
    $result = $conn->query($Vioquery) or die($conn->error);
    while ($vtype = $result->fetch_array()) {
        $violation_type_id = $vtype['violation_type_id'];
    }
    $result->close();

//grab violator ID
//Search violator table to check if input violator name is new or not
    $Vioquery = "SELECT * FROM violator WHERE driver_license = '". $driver_license ."'";
    $result = $conn->query($Vioquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find violator in violator table
    // that means its a new violator, so add it into the violator table
    if($count == 0) {
        $addVio = "INSERT INTO violator (driver_license, name)
        VALUES (?, ?)";
        $stmt = $conn->prepare($addVio);
        $stmt->bind_param('ss', $driver_license, $violator);
        if($stmt->execute()) {
            echo "violator works.";
        } else {
            die($conn-error);
        }
        $violator_id = $conn->insert_id;
        $stmt->close();
        $result->close();
    } else {
        while ($Vio = $result->fetch_array()) {
            $violator_id = $Vio['violator_id'];
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
        $addM = "INSERT INTO vehicle_manufacturers (name) VALUES (?)";
        $stmt = $conn->prepare($addM);
        $stmt->bind_param('s', $manufacturer_name);
        if($stmt->execute()) {
            echo "manufacturer works.";
        } else {
            die ($conn->error);
        }
        $manufacturer_code = $conn->insert_id;
        $stmt->close();
        $result->close();
    } else {
        while ($M = $result->fetch_array()) {
            $manufacturer_code = $M['manufacturer_code'];
        }
        $result->close();
    }

//grab vehicle type ID
//Search vehicle_type table to check if input vehicle type name is new or not
    $VTquery = "SELECT * FROM vehicle_type WHERE name = '". $vehicle_type ."' LIMIT 1";
    $result = $conn->query($VTquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find vehicle type in vehicle type table
    // that means its a new brand, so add it into the vehicle_type table
    if($count == 0) {
        $addVT = "INSERT INTO vehicle_type (name) VALUES (?)";
        $stmt = $conn->prepare($addVT);
        $stmt->bind_param('s', $vehicle_type);
        if($stmt->execute()) {
            echo "vehicle type works.";
        } else {
            die ($conn->error);
        }
        $vehicle_type_id = $conn->insert_id;
        $stmt->close();
        $result->close();
  
    } else {
        while ($VT = $result->fetch_array()) {
            $vehicle_type_id = $VT['vehicle_type_id'];
        }
        $result->close();
    }

    
//Search vehicle table to check if input license plate number is new or not
    $Vquery = "SELECT * FROM vehicle WHERE license_plate='". $license_plate ."' LIMIT 1";
    $result = $conn->query($Vquery) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find license plate in vehicle table
    // that means its a new vehicle, so add it into the vehicle table
    if($count == 0) {
        $addV = "INSERT INTO vehicle (license_plate, name, colour, vehicle_type_id, manufacturer_code)
        VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($addV);
        $stmt->bind_param('sssii', $license_plate, $vehicle_name, $vehicle_colour, $vehicle_type_id, $manufacturer_code);
        $stmt->execute();
        $stmt->close();
        $result->close();
    }


//Search violation table to check if the input violation number is new or not
    $query = "SELECT * FROM violation WHERE violation_number = '". $violation_number ."' LIMIT 1";
    $result = $conn->query($query) or die($conn->error);
    $count = $result->num_rows;
    // if cannot find the input violation number in the violation table
    // that means its a new violation number, so add it into the violation table
    if($count == 0) {
        $addTicket = "INSERT INTO violation (violation_number, violation_date, fine_amount, fine_due_date, violator_id, violation_type_id, license_plate)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($addTicket) or die($conn->error);
        $stmt->bind_param("ssssiis", $violation_number, $violation_date, $fine_amount, $fine_due_date, $violator_id, $violation_type_id, $license_plate);
        $stmt->execute();
        $violation_id = $conn->insert_id;
        $stmt->close();
        $result->close();

        //flash message
        $_SESSION['message'] = "Ticket is successfully added.";
        $_SESSION['alert-class'] = "alert-success";        
        header('location: index.php');
        exit();
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
                    <label for="violation_number">Violation Number: </label>
                    <input type="text" name="violation_number" value="<?php echo $violation_number; ?>" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="violation_type">Violation type: </label>
                    <select name="violation_type" placeholder="">
                        <option value=""></option>
                        <option value="Red Light"> Red Light </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="violation_date">Violation_date: </label>
                    <input type="text" name="violation_date" placeholder="YYYY-MM-DD" value="<?php echo $violation_date; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="violator">violator: </label>
                    <input type="text" name="violator" value="<?php echo $violator; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="driver_license">Driver's License: </label>
                    <input type="text" name="driver_license" value="<?php echo $driver_license; ?>" placeholder= ""class="form-control form-control-lg" required>
                </div>
                
                <div class="form-group">
                    <label for="license_plate">License Plate Number: </label>
                    <input type="text" name="license_plate" value="<?php echo $license_plate; ?>" placeholder="XXX-YYY" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_name">Vehicle Name: </label>
                    <input type="text" name="vehicle_name" value="<?php echo $vehicle_name; ?>" placeholder="" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_colour">Vehicle Colour: </label>
                    <input type="text" name="vehicle_colour" value="<?php echo $vehicle_colour; ?>" placeholder="" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_type">Vehicle Brand: </label>
                    <input type="text" name="vehicle_type" value="<?php echo $vehicle_type; ?>" placeholder="e.g. Audi" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="manufacturer_name">Manufacturer: </label>
                    <input type="text" name="manufacturer_name" value="<?php echo $manufacturer_name; ?>" placeholder="e.g. Audi" class="form-control form-control-lg" required>
                </div>


                <div class="form-group">
                    <label for="fine_amount">Fine Amount: </label>
                    <input type="text" name="fine_amount" placeholder="e.g. 123.45" value="<?php echo $fine_amount; ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="fine_due_date">Fine Due Date:</label>
                    <input type="text" name="fine_due_date" placeholder="YYYY-MM-DD" value="<?php echo $fine_due_date; ?>" class="form-control form-control-lg" required>
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
