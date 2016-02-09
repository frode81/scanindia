<?php

ini_set("display_erros", "true");
include 'includes/SocketServer.class.php';
$conn = mysqli_connect("localhost","root", "22@nishant", "scanindia");
ob_implicit_flush();
define("HOST", "ec2-52-89-229-139.us-west-2.compute.amazonaws.com");
define("PORT", "2000");
define("MAX_CLIENTS", 100);

function handle_connect($server, $client, $input) {
    echo "Client Connected";
    ob_flush();
    flush();
}

function handle_input($server, $client, $input) {
    $data = trim($input);

    if (strtolower($data) == "quit") { // User Wants to quit the server
        SocketServer::socket_write_smart($client->socket, "Oh... Goodbye..."); // Give the user a sad goodbye message, meany!
        $server->disconnect($client->server_clients_index); // Disconnect this client.
        return; 
    }
    $deviceId = substr($data, 1, 10);
    $messageCode = substr($data, 11, 2);
    $date = substr($data, 13, 6);
    $time = substr($data, 19, 6);
    $inputVoltage = substr($data, 25, 3);
    $currentLoad = substr($data, 28, 5);
    $status = substr($data, 33, 3);
    $lowCutSetPoint = substr($data, 36, 3);
    $highCutSetPoint = substr($data, 39, 3);
    $overLoadSetPoint = substr($data, 42, 2);
    
    global $conn;
    $sql = "INSERT INTO audit(device_id, time, date, input_voltage, current_load, status, low_cut_set, high_cut_set, message_code, overload_set) values(" . "'" . $deviceId . "'" . ","
            . "'" . htmlspecialchars($time) . "'" . ","
            . "'" . htmlspecialchars($date) . "'" . ","
            . "'" . htmlspecialchars($inputVoltage) . "'" . ","
            . "'" . htmlspecialchars($currentLoad) . "'" . ","
            . "'" . htmlspecialchars($status) . "'" . ","
            . "'" . htmlspecialchars($lowCutSetPoint) . "'" . ","
            . "'" . htmlspecialchars($highCutSetPoint) . "'" . ","
            . "'" . htmlspecialchars($messageCode) . "'" . ","
            . "'" . htmlspecialchars($overLoadSetPoint) . "'" .")";
           
    if ($conn->query($sql) === TRUE) {
        $success = "Auditing Done";
        echo $success;
        ob_flush();
        flush();
    } else {
        $error = "Error: " . $conn->error;
        echo $error;
        ob_flush();
        flush();
    }

    //SocketServer::socket_write_smart($client->socket,$output); // Send the Client back the String
    //SocketServer::socket_write_smart($client->socket,"a? ",""); // Request Another String
}
