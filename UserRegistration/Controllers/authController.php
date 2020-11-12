<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once 'config/db.php';

$username = "";
$email = "";
$errors = array();

//if user clicks on the register button

if (isset($_POST['register-btn'])) {
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    //validation
    
    if(empty($usertype)) {
        $errors['usertype'] = "Usertype required";
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
    $emailQuery = "SELECT * FROM employees WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    
    if($userCount > 0) {
        $errors['email'] = "Email already exists";
    }
    
    if(count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;
        
        $sql = "INSERT INTO users (username, email, verified, token, password, usertype)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssbsss', $username, $email, $verified, $token, $password, $usertype);
        
        if($stmt->execute()) {
            //login user
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;
            $_SESSION['usertype'] = $usertype;
           
            //flash message
            $_SESSION['message'] = "Login successful";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php');
            exit();           
        } else {
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
        $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])) {
            // correct password, allow login
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = $user['verified'];
            $_SESSION['usertype'] = $user['usertype'];
            //flash message
            $_SESSION['message'] = "Login successful";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php');
            exit();        
        } else {
            $errors['login_fail'] = "Wrong credentials";
        }        
    }
    
}

//logout user
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    unset($_SESSION['usertype']);    
    header('location: login.php');
    exit(0);
}

function verifyEmail($token) {
    global $conn;
    $sql = "SELECT verified, token FROM users WHERE verified=0 AND token='$token' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $update = "UPDATE users SET verified=1 WHERE token='$token' LIMIT 1";

        if ($update) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['message'] = "Your email address has been verified successfully";
            $_SESSION['type'] = 'alert-success';
            header('location: index.php');
            exit();
        }
    } else {
        echo "User not found!";
    }
}
