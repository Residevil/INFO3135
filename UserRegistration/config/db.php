<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'constants.php'; //use to contain sensitive data
        

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Database error: ' . $conn->connect_error);



?>