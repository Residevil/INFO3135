<?php

require_once 'config/db.php';


function search_print($results) {
    global $conn; 
    global $table;
    echo "<table class='table table-striped' $table>

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
    </th>";

    
    while($row = $results->fetch_array()) {
        $_SESSION['violation_id'] = $row['violation_id'];
        $_SESSION['violation_number'] = $row['violation_number'];
        $_SESSION['violation_type_id'] = $row['violation_type_id'];
        $sql = "SELECT violation.violation_type_id, violation_type.violation_type_id, violation_type.name FROM `violation` RIGHT JOIN `violation_type` ON violation.violation_type_id = violation_type.violation_type_id";
        $vt = $conn->query($sql) or die($conn->error);
        while ($vtype = $vt->fetch_array()) {
            $_SESSION['violation_type'] = $vtype['name'];
        }
        $_SESSION['violator_id'] = $row['violator_id'];
        $query = "SELECT violation.violator_id, violator.violator_id, violator.name FROM `violation` RIGHT JOIN `violator` ON violation.violator_id = violator.violator_id";
        $v = $conn->query($query) or die($conn->error);
        while ($vio = $v->fetch_array()) {
            $_SESSION['violator'] = $vio['name'];
        }
        $_SESSION['violation_date'] = $row['violation_date'];
        $_SESSION['license_plate'] = $row['license_plate'];	
        $_SESSION['fine_amount'] = $row['fine_amount']; 
        $_SESSION['fine_due_date'] = $row['fine_due_date'];
        
        echo "<tr>";

        echo "<td>" . $_SESSION['violation_number'] . "</td>";

        echo "<td>" . $_SESSION['violation_type'] . "</td>";

        echo "<td>" . $_SESSION['violation_date'] . "</td>";

        echo "<td>" . $_SESSION['license_plate'] . "</td>";

        echo "<td>" . $_SESSION['fine_amount'] . "</td>";

        echo "<td>" . $_SESSION['fine_due_date'] . "</td>";

        echo "<td><input type='radio' name='select_ticket'></td>";   

        echo "</tr>";

    }
    echo "</table>";
}

if(isset($_POST['payment_btn'])) {
    header('location: payment.php');
}

if(isset($_POST['search-btn'])) {
    $search = $_POST['search'];
    //$search = preg_replace("#[^0-9a-z\s]#i","",$search);

    $words = explode(' ', $search);
    $regex = implode('|', $words);

    $query = "SELECT * FROM violation WHERE violation_number = '". $search ."' OR license_plate = '".$search."'";
    $result = $conn->query($query) or die($conn->error);
    $count = $result->num_rows;
    if($count == 0 || empty($search)){
        $output = 'There are zero results';
    } else {
        $table = '';
        $output = $result;
    } 
    //  else {
    //     $table='';
    //     while($row = $result->fetch_array()) {
    //         $sql = "SELECT violation.violation_type_id, violation_type.violation_type_id, violation_type.name FROM `violation` RIGHT JOIN `violation_type` ON violation.violation_type_id = violation_type.violation_type_id";
    //         $vt = $conn->query($sql) or die($conn->error);
    //         while ($vtype = $vt->fetch_array()) {
    //             $_SESSION['violation_type'] = $vtype['name'];
    //         }
    //         $query = "SELECT violation.violator_id, violator.violator_id, violator.name FROM `violation` RIGHT JOIN `violator` ON violation.violator_id = violator.violator_id";
    //         $v = $conn->query($query) or die($conn->error);
    //         while ($vio = $v->fetch_array()) {
    //             $_SESSION['violator'] = $vio['name'];
    //         }
    //        $output = $row['violation_number'] . " " . $row['violation_type']. $row['violation_date']. $row['license_plate']. $row['fine_amount']. $row['fine_due_date'];
    //     } 
    // }
}



?>

