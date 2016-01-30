<?php

ini_set('max_execution_time', 30); //300 seconds = 5 minutes
ob_implicit_flush();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "52.24.23.73";
$port = 5000;
$data = '(8587042851AA13111514523726501.5000016032010)';

if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === FALSE)
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error());
else {
    echo "Attempting to connect to '$host' on port '$port'...<br>";
    ob_flush();
    flush();
    if (($result = socket_connect($socket, $host, $port)) === FALSE)
        echo "socket_connect() failed. Reason ($result) " . socket_strerror(socket_last_error($socket));
    else {
        while (1) {
            sleep(2);
            socket_write($socket, $data, strlen($data));
        }
    }
    socket_close($socket);
}