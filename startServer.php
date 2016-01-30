<?php

require_once 'includes/tcpConnection.php';

$server = new SocketServer(HOST, PORT);

$server->max_clients = MAX_CLIENTS;
$server->hook("CONNECT", "handle_connect");
$server->hook("INPUT", "handle_input");
$server->infinite_loop();
