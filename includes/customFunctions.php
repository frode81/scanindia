<?php

date_default_timezone_set("Asia/Kolkata");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customFunctions
 *
 * @author Nishant Goel
 */
class customFunctions {

    //put your code here

    public static function getDeviceStatus($deviceId) {
        $conn = mysqli_connect("localhost", "root", "root", "scanindia");
        $before10seconds = strtotime(date('Y-m-d H:i:s')) - (10);
        $sql = "SELECT * FROM scanindia.audit WHERE device_id = " . "'" . $deviceId . "'" . " AND CREATED BETWEEN date_sub(now(), interval 10 second) AND now() ORDER BY CREATED DESC LIMIT 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $status = "<td style='color:green'>Online</td>";
        } else {
            $status = "<td style='color:red'>Ofline</td>";
        }
        return $status;
    }

    public static function getDeviceData($deviceId) {
        $conn = mysqli_connect("localhost", "root", "", "scanindia");
        $before10seconds = strtotime(date('Y-m-d H:i:s')) - (10);
        $sql = "SELECT * FROM scanindia.audit WHERE device_id = " . "'" . $deviceId . "'" . " AND CREATED BETWEEN date_sub(now(), interval 5 second) AND now() ORDER BY CREATED DESC LIMIT 1;";
        $result = $conn->query($sql);
        return $result;
    }

}
