<?php

require_once 'config/db.php';

if(isset($_POST['search-btn'])) {
    $search = $_POST['search'];
    
    $query = "SELECT * FROM Violations WHERE ViolationNumber = '". $search ."' OR LicensePlateNumber = '".$search."'";
    $result = $conn->query($query) or die($conn->error);
    $count = $result->num_rows;
    if($count == 0 || empty($search)){
        $output = 'There are zero results';
    } else{
        $table = '';
        while($row = $result->fetch_array()) {
            $_SESSION['ViolationID'] = $row['ViolationID'];
            $_SESSION['ViolationNumber'] = $row['ViolationNumber'];
            $_SESSION['ViolationTypeID'] = $row['ViolationTypeID'];
            $sql = "SELECT Violations.ViolationTypeID, ViolationType.ViolationTypeID, ViolationType.Name FROM `Violations` RIGHT JOIN `ViolationType` ON Violations.ViolationTypeID = ViolationType.ViolationTypeID";
            $vt = $conn->query($sql) or die($conn->error);
            while ($vtype = $vt->fetch_array()) {
                $_SESSION['ViolationType'] = $vtype['Name'];
            }
            $_SESSION['ViolatorID'] = $row['ViolatorID'];
            $query = "SELECT Violations.ViolatorID, Violators.ViolatorID, Violators.Name FROM `Violations` RIGHT JOIN `Violators` ON Violations.ViolatorID = Violators.ViolatorID";
            $v = $conn->query($query) or die($conn->error);
            while ($vio = $v->fetch_array()) {
                $_SESSION['Violator'] = $vio['Name'];
            }
            $_SESSION['ViolationDate'] = $row['ViolationDate'];
            $_SESSION['LicensePlateNumber'] = $row['LicensePlateNumber'];	
            $_SESSION['FineAmount'] = $row['FineAmount']; 
            $_SESSION['FineDueDate'] = $row['FineDueDate'];
        }
    }

}

?>
