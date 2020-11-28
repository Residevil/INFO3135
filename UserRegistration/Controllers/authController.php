<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once 'config/db.php';

$name = "";
$username = "";
$email = "";
$errors = array();

//if user clicks on the register button

if (isset($_POST['register-btn'])) {
    $employeetype = $_POST['employeetype'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalcode = $_POST['postalcode'];


    //validation
    
    if(empty($employeetype)) {
        $errors['employeetype'] = "Employee Type required";
    }

    if(empty($name)) {
        $errors['name'] = "Name required";
    }

    if(empty($username)) {
        $errors['username'] = "Username required";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }

    if(empty($email)) {
        $errors['email'] = "Email required";
    }

    if(empty($password)) {
        $errors['password'] = "Password required";
    }

    if($password != $passwordConf) {
        $errors['password'] = "Two password do not match";
    }

    //unique email validation
    $emailQuery = "SELECT * FROM employee WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    
    if($userCount > 0) {
        $errors['email'] = "Email already exists";
    }

    if($employeetype === "Administrator") {
        $employee_type_id = 1;
    } else {
        $employee_type_id = 2;
    }

    //clarify province name
    switch($province) {
        case "AB":
            $province = "Alberta";
        break;
        case "BC":
            $province = "British Columbia";
        break;
        case "MB":
            $province = "Manitoba";
        break;
        case "NB":
            $province = "New Brunswick";
        break;
        case "NL":
            $province = "Newfoundland and Labrador";
        break;
        case "NS":
            $province = "Nova Scotia";
        break;
        case "NT":
            $province = "Northwest Territories";
        break;
        case "NU":
            $province = "Nunavut";
        break;
        case "ON":
            $province = "Ontario";
        break;
        case "PE":
            $province = "Prince Edward Island";
        break;
        case "QC":
            $province = "Quebec";
        break;
        case "SK":
            $province = "Saskatchewan";
        break;
        case "YT":
            $province = "Yukon";
        break;
    }
    
    if(count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        // $token = bin2hex(random_bytes(50));
        // $verified = false;


        $add = "INSERT INTO addresses (street_name, city, Province, postal_code)
                VALUES (?, ?, ?, ?)";
        $stmt0 = $conn->prepare($add);
        $stmt0->bind_param('ssss', $address, $city, $province, $postalcode);
        $stmt0->execute();
        $address_id=$conn->insert_id;
        $sql = "INSERT INTO employee (name, username, email, password, employee_type_id, address_id)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssii', $name, $username, $email, $password, $employee_type_id, $address_id);


        if($stmt->execute()) {
            //login user
            $edit = 'visible';
            $employee_id = $conn->insert_id;
            $_SESSION['employee_id'] = $employee_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['employee_type_id'] = $employee_type_id;
           
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    //validation
    if(empty($username)) {
        $errors['username'] = "Username required"; 
    }

    if(empty($password)) {
        $errors['password'] = "Password required";
    }

    if(count($errors) === 0) {
        $sql = "SELECT * FROM employee WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])) {
            // correct password, allow login
            $_SESSION['employee_id'] = $user['employee_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['employee_type_id'] = $user['employee_type_id'];
            $_SESSION['address_id'] = $user['address_id'];
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
    unset($_SESSION['employee_id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['employee_type_id']);
    unset($_SESSION['address_id']);    
    header('location: login.php');
    exit();
}
