<?php

require_once 'config/db.php';

$output = '';
$hidden = 'hidden';
$ViolationID = '';
$ViolationNumber = '';
$ViolationTypeID = '';
$ViolationType = '';
$vt = '';
$ViolationDate = '';
$LicensePlateNumber = '';
$FineAmount = '';
$FineDueDate = '';

if(isset($_POST['search-btn'])) {
    $search = $_POST['search'];

    $query = "SELECT * FROM Violations WHERE ViolationNumber = '". $search ."' OR LicensePlateNumber = '".$search."'";
    $result = $conn->query($query) or die($conn->error);
    $count = $result->num_rows;
    if($count == 0 || empty($search)){
        $output = 'There are zero results';
    } else{
        $hidden = '';
        while($row = $result->fetch_array()) {
            $ViolationID = $row['ViolationID'];
            $ViolationNumber = $row['ViolationNumber'];
            $ViolationTypeID = $row['ViolationTypeID'];
            $sql = "SELECT Violations.ViolationTypeID, ViolationType.ViolationTypeID, ViolationType.Name FROM Violations RIGHT JOIN ViolationType ON Violations.ViolationTypeID = ViolationType.ViolationTypeID";
            $vt = $conn->query($sql) or die($conn->error);
            while ($v = $vt->fetch_array()) {
                $ViolationType = $v['Name'];
            }
            $ViolationDate = $row['ViolationDate'];
            $LicensePlateNumber = $row['LicensePlateNumber'];	
            $FineAmount = $row['FineAmount']; 
            $FineDueDate = $row['FineDueDate'];
        }
    }
}

?>
