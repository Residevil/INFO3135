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
         $address= "CREATE TABLE Addresses (
            AddressID INT(11) NOT NULL AUTO_INCREMENT,
            StreetNumber INT(11),
            StreetName VARCHAR(50) NOT NULL,
            UnitNumber INT(11),
            City VARCHAR(20) NOT NULL,
            Province VARCHAR(20) NOT NULL,
            PostalCode VARCHAR(11) NOT NULL,
            PRIMARY KEY(AddressID)
        )";
        $conn->query($address);

        $employee_type = "CREATE TABLE EmployeeType (
            EmployeeTypeID INT(11) NOT NULL,
            Name VARCHAR(50) NOT NULL,
            Description VARCHAR(255) NOT NULL,
            PRIMARY KEY(EmployeeTypeID)
        )";
        $conn->query($employee_type)

        $employee = "CREATE TABLE Employee (
            EmployeeID INT(11) NOT NULL AUTO_INCREMENT,
            Name VARCHAR(50) NOT NULL,
            Username VARCHAR(11),
            Email VARCHAR(255),
            Password VARCHAR(255),
            EmployeeTypeID INT(11),
            AddressID INT(11),	
            PRIMARY KEY(EmployeeID),
            FOREIGN KEY(EmployeeTypeID) REFERENCES EmployeeType(EmployeeTypeID),
            FOREIGN KEY(AddressID) REFERENCES Addresses(AddressID)
        )";
        $conn->query($employee);

        $violator = "CREATE TABLE Violators (
            ViolatorID INT(11) NOT NULL AUTO_INCREMENT,
            DriversLicenseNumber VARCHAR(50) NOT NULL,
            Name VARCHAR(50) NOT NULL,
            AddressID INT(11),
            PRIMARY KEY(ViolatorID),
            FOREIGN KEY(AddressID) REFERENCES Addresses(AddressID)
        )";
        $conn->query($violator);

        $vehicle_type = "CREATE TABLE VehicleType (
            VehicleTypeID INT(11) NOT NULL,
            Name VARCHAR(50) NOT NULL,
            Description VARCHAR(255) NOT NULL,
            PRIMARY KEY(VehicleTypeID)
        )";
        $conn->query($vehicle_type);

        $manufacturer = "CREATE TABLE Manufacturers (
            ManufacturerCode INT(50) NOT NULL,
            ManufacturerName VARCHAR(50) NOT NULL,
            PRIMARY KEY(ManufacturerCode)
        )";
        $conn->query($manufacturer);

        $vehicle = "CREATE TABLE Vehicles (
            LicensePlateNumber VARCHAR(11) NOT NULL,
            Name VARCHAR(20) NOT NULL,
            Colour VARCHAR(20) NOT NULL,
            VehicleTypeID INT(11),
            ManufacturerCode INT(50),
            PRIMARY KEY(LicensePlateNumber),
            FOREIGN KEY(VehicleTypeID) REFERENCES VehicleType(VehicleTypeID),
            FOREIGN KEY(ManufacturerCode) REFERENCES Manufacturers(ManufacturerCode)
        )";
        $conn->query($vehicle);

        $violation_type = "CREATE TABLE ViolationType (
            ViolationTypeID INT(11) NOT NULL,
            Name VARCHAR(50) NOT NULL,
            Description VARCHAR(255)NOT NULL,
            PRIMARY KEY(ViolationTypeID)
        )";
        $conn->query($violation_type);

        $violation = "CREATE TABLE Violations (
            ViolationID INT(11) NOT NULL AUTO_INCREMENT,
            ViolationNumber INT(50) NOT NULL,
            ViolationDate VARCHAR NOT NULL,
            FineAmount VARCHAR(11) NOT NULL,
            FineDueDate VARCHAR NOT NULL,
            ViolatorID INT(11),
            ViolationTypeID INT(11),
            LicensePlateNumber VARCHAR(11),
            PRIMARY KEY(ViolationID),
            FOREIGN KEY(ViolationTypeID) REFERENCES ViolationType(ViolationTypeID),
            FOREIGN KEY(ViolatorID) REFERENCES Violators(ViolatorID),
            FOREIGN KEY(LicensePlateNumber) REFERENCES Vehicles(LicensePlateNumber)
        )";
        $conn->query($violation);

        $payment_method = "CREATE TABLE PaymentMethod (
            PaymentMethodCode INT(11) NOT NULL,
            Name VARCHAR(50) NOT NULL,
            Description VARCHAR(255) NOT NULL,
            PRIMARY KEY(PaymentMethodCode)
        )";
        $conn->query($payment_method);

    }
    else { echo "Error creating table: " . $conn->error;}
}




?>
