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
         $address= "CREATE TABLE addresses (
            address_id INT(11) NOT NULL AUTO_INCREMENT,
            street_number INT(11),
            street_name VARCHAR(50) NOT NULL,
            unit_number INT(11),
            city VARCHAR(20) NOT NULL,
            province VARCHAR(20) NOT NULL,
            postal_code VARCHAR(11) NOT NULL,
            PRIMARY KEY(address_id)
        )";
        $conn->query($address);

        $employee_type = "CREATE TABLE employee_type (
            employee_type_id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255),
            PRIMARY KEY(employee_type_id)
        )";
        $conn->query($employee_type)

        $employee = "CREATE TABLE employee (
            employee_id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            username VARCHAR(11),
            email VARCHAR(255),
            password VARCHAR(255),
            employeey_type_id INT(11),
            address_id INT(11),	
            PRIMARY KEY(employee_id),
            FOREIGN KEY(employee_type_id) REFERENCES employee_type(employee_type_id),
            FOREIGN KEY(address_id) REFERENCES addresses(address_id)
        )";
        $conn->query($employee);

        $violator = "CREATE TABLE violator (
            violator_id INT(11) NOT NULL AUTO_INCREMENT,
            driver_license VARCHAR(50) NOT NULL,
            name VARCHAR(50) NOT NULL,
            address_id INT(11),
            PRIMARY KEY(violator_id),
            FOREIGN KEY(address_id) REFERENCES addresses(address_id)
        )";
        $conn->query($violator);

        $vehicle_type = "CREATE TABLE vehicle_type (
            vehicle_type_id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255),
            PRIMARY KEY(vehicle_type_id)
        )";
        $conn->query($vehicle_type);

        $manufacturer = "CREATE TABLE vehicle_manufacturers (
            manufacturer_code INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            PRIMARY KEY(manufacturer_code)
        )";
        $conn->query($manufacturer);

        $vehicle = "CREATE TABLE vehicle (
            license_plate VARCHAR(11) NOT NULL,
            name VARCHAR(20) NOT NULL,
            colour VARCHAR(20) NOT NULL,
            vehicle_type_id INT(11),
            manufacturer_code INT(50),
            PRIMARY KEY(license_plate),
            FOREIGN KEY(vehicle_type_id) REFERENCES vehicle_type(vehicle_type_id),
            FOREIGN KEY(manufacturer_code) REFERENCES vehicle_manufacturers(manufacturer_code)
        )";
        $conn->query($vehicle);

        $violation_type = "CREATE TABLE violation_type (
            violation_type_id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255),
            PRIMARY KEY(violation_type_id)
        )";
        $conn->query($violation_type);
        $conn->query("INSERT INTO violation_type ('Red Light', 'Pass red light')");

        $violation = "CREATE TABLE violation (
            violation_id INT(11) NOT NULL AUTO_INCREMENT,
            violation_number INT(50) NOT NULL,
            violation_date VARCHAR NOT NULL,
            fine_Amount VARCHAR(11) NOT NULL,
            fine_due_date VARCHAR NOT NULL,
            violator_id INT(11),
            violation_type_id INT(11),
            license_plate VARCHAR(11),
            PRIMARY KEY(violation_id),
            FOREIGN KEY(violation_type_id) REFERENCES violation_type(violation_type_id),
            FOREIGN KEY(violator_id) REFERENCES violator(violator_id),
            FOREIGN KEY(license_plate) REFERENCES vehicle(license_plate)
        )";
        $conn->query($violation);

        $payment_method = "CREATE TABLE payment_methods (
            payment_method_code INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255),
            PRIMARY KEY(payment_method_code)
        )";
        $conn->query($payment_method);

    }
    else { echo "Error creating table: " . $conn->error;}
}




?>
