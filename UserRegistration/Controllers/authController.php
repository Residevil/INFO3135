<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once 'config/db.php';
require_once 'config/constants.php';


//if user clicks on the register button
if (isset($_POST['register-btn'])) {
    $EmployeeType = $_POST['EmployeeType'];
    $Name = $_POST['Name'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $PasswordConf = $_POST['PasswordConf'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $PostalCode = $_POST['PostalCode'];


    //validation
    
    if(empty($EmployeeType)) {
        $errors['EmployeeType'] = "Employee Type required";
    }

    if(empty($Name)) {
        $errors['Name'] = "Name required";
    }

    if(empty($Username)) {
        $errors['Username'] = "Username required";
    }

    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Email address is invalid";
    }

    if(empty($Email)) {
        $errors['Email'] = "Email required";
    }

    if(empty($Password)) {
        $errors['Password'] = "Password required";
    }
    
    if(empty($PasswordConf)) {
        $errors['PasswordConf'] = "Password Confirm required";
    }

    if($password != $passwordConf) {
        $errors['Password'] = "Two password do not match";
    }

    //unique email validation
    $emailQuery = "SELECT * FROM Employee WHERE Email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $Email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    
    if($userCount > 0) {
        $errors['Email'] = "Email already exists";
    }

    if($EmployeeType === "Administrator") {
        $EmployeeTypeID = 1;
    } else {
        $EmployeeTypeID = 2;
    }

    //clarify province name
    switch($Province) {
        case "AB":
            $Province = "Alberta";
        break;
        case "BC":
            $Province = "British Columbia";
        break;
        case "MB":
            $Province = "Manitoba";
        break;
        case "NB":
            $Province = "New Brunswick";
        break;
        case "NL":
            $Province = "Newfoundland and Labrador";
        break;
        case "NS":
            $Province = "Nova Scotia";
        break;
        case "NT":
            $Province = "Northwest Territories";
        break;
        case "NU":
            $Province = "Nunavut";
        break;
        case "ON":
            $Province = "Ontario";
        break;
        case "PE":
            $Province = "Prince Edward Island";
        break;
        case "QC":
            $Province = "Quebec";
        break;
        case "SK":
            $Province = "Saskatchewan";
        break;
        case "YT":
            $Province = "Yukon";
        break;
    }
    
    if(count($errors) === 0) {
        $Password = password_hash($Password, PASSWORD_DEFAULT);
        // $token = bin2hex(random_bytes(50));
        // $verified = false;


        $add = "INSERT INTO Addresses (StreetName, City, Province, Postal_Code)
                VALUES (?, ?, ?, ?)";
        $stmt0 = $conn->prepare($add);
        $stmt0->bind_param('ssss', $Address, $City, $Province, $PostalCode);
        $stmt0->execute();
        $AddressID=$conn->insert_id;
        $sql = "INSERT INTO Employee (Name, Username, Email, Oassword, EmployeeTypeID, AddressID)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssii', $Name, $Username, $Email, $Password, $EmployeeTypeID, $AddressID);


        if($stmt->execute()) {
            //login user
            $edit = 'visible';
            $EmployeeID = $conn->insert_id;
            $_SESSION['EmployeeID'] = $EmployeeID;
            $_SESSION['Username'] = $Username;
            $_SESSION['Email'] = $Email;
            $_SESSION['EmployeeTypeID'] = $EmployeeTypeID;
           
            //flash message
            $_SESSION['message'] = "Login successful";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php');
            exit();           
        } 
        else {
            $errors['db_error'] = "Database error: failed to register";
        }
        
    }

}

//if user clicks the login button

if (isset($_POST['login-btn'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    //validation
    if(empty($Username)) {
        $errors['Username'] = "Username required"; 
    }

    if(empty($Password)) {
        $errors['Password'] = "Password required";
    }

    if(count($errors) === 0) {
        $sql = "SELECT * FROM Employee WHERE Email=? OR Username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $Username, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify($Password, $user['Password'])) {
            // correct password, allow login
            $_SESSION['EmployeeID'] = $user['EmployeeID'];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Email'] = $user['Email'];
            $_SESSION['EmployeTypeID'] = $user['EmployeeTypeID'];
            $_SESSION['AddressID'] = $user['AddressID'];
            //flash message
            $_SESSION['message'] = "Login successful";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php');
            exit();        

        } 
        else {
            $errors['login_fail'] = "Wrong credentials";
        }        
    }
    
}

//logout user
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['EmployeeID']);
    unset($_SESSION['Username']);
    unset($_SESSION['Email']);
    unset($_SESSION['EmployeeTypeID']);
    unset($_SESSION['AddressID']);    
    header('location: login.php');
    exit();
}
