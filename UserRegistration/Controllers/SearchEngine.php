<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Simple search

if(isset($_GET['search_btn'])) {
    $search = $_GET['search'];
    $herbQuery = "SELECT name FROM herbs WHERE name = $search";
    $stmt = $conn->prepare($herbQuery);
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        echo $result;
    }
}

?>