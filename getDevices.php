<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = mysqli_connect("localhost", "root", "22@nishant", "scanindia");
$sql = "SELECT * from devices";
$result = mysqli_query($conn, $sql);

header('Content-Type: application/json');
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));