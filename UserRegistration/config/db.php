<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'constants.php'; //use to contain sensitive data
        

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS) or die ('Database error: ' . $conn->connect_error);

$db_selected = $conn->select_db( DB_NAME );
if(!$db_selected) {
    $db = "CREATE DATABASE IF NOT EXISTS INFO 2413";
    $conn->query($db);

    $conn->select_db( DB_NAME );

    if ($conn->query($db) === TRUE) {
            // sql to create table.
        $employees = "CREATE TABLE employees (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(20) NOT NULL , 
            email VARCHAR(50) NOT NULL UNIQUE, 
            verified TINYINT(4) NOT NULL, 
            token VARCHAR(100) NOT NULL, 
            password VARCHAR(100) NOT NULL,
            employee_type_id INT(11) NOT NULL FOREIGN KEY REFERENCE employee_type (id)
        )";

        $employee_type = "CREATE TABLE employee_type (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
            employee_type VARCHAT(50) NOT NULL
        )";

        $ticket = "CREATE TABLE ticket (
            ticket_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            ticket_num INT(20) NOT NULL ,
            Car_license VARCHAR(10) NOT NULL UNIQUE, 
            ticket_type VARCHAT(50) NOT NULL
        )";

        $ticket_type = "CREATE TABLE ticket_type (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            ticket_type VARCHAT(50) NOT NULL,
            file_No INT(50) NOT NULL
        )";
    }
    else { echo "Error creating table: " . $conn->error;}
}




?>
