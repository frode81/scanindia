<?php require_once 'includes/header.php'; ?>
<?php ini_set('display_errors','true'); ?>
<?php $conn = mysqli_connect("localhost","root", "22@nishant", "scanindia"); ?>
<?php
if (isset($_POST['Register'])) {
    $sql = "INSERT INTO devices(device_number, address, city, state, latitude, longitude, country, is_active ) values(" . "'" . $_POST['deviceNumber'] . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceAddress']) . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceCity']) . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceState']) . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceLatitude']) . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceLongitude']) . "'" . ","
            . "'" . htmlspecialchars($_POST['deviceCountry']) . "'" . "," . '1' . ")";
    if ($conn->query($sql) === TRUE) {
        $success = "Device has been succesfully registered";
    } else {
        $error = "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<!-- Page Content -->
<div class="container">

    <div class="row">
        <?php if (!isset($_GET['device_id'])): ?>
            <div class="col-lg-4">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" <?php if (isset($_GET['register_device'])) echo "class='active'"; ?>><a href="devices.php?register_device">Register Device</a></li>
                    <li role="presentation" <?php if (isset($_GET['view_device'])) echo "class='active'"; ?> ><a href="devices.php?view_device">View Devices</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['register_device'])): ?>
            <div class="col-lg-8">
                <div class="jumbotron" style="min-height:500px">
                    <h3 class="text-info text-center">Register Device</h3>
                    <div>
                        <?php if (isset($success)): ?>
                            <?php echo "<p class='alert alert-success'>" . $success . "</p>"; ?>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <?php echo "<p class='alert alert-danger'>" . $error . "</p>"; ?>
                        <?php endif; ?>
                    </div>
                    <form method="POST" action="devices.php?register_device" name="deviceForm">
                        <div class="form-group">
                            <label for="deviceNumber">Device Number</label>
                            <input type="text" class="form-control" id="deviceNumber" name="deviceNumber" placeholder="Device Number">
                        </div>
                        <div class="form-group">
                            <label for="deviceAddress">Address</label>
                            <input type="text" class="form-control" id="deviceAddress" name="deviceAddress" placeholder="Device Address">
                        </div>
                        <div class="form-group">
                            <label for="deviceCity">City</label>
                            <input type="text" class="form-control" id="deviceCity" name="deviceCity" placeholder="Device City">
                        </div>
                        <div class="form-group">
                            <label for="deviceState">State</label>
                            <input type="text" class="form-control" id="deviceState" name="deviceState" placeholder="Device Number">
                        </div>
                        <div class="form-group">
                            <label for="deviceCountry">Country</label>
                            <input type="text" class="form-control" id="deviceCountry" name="deviceCountry" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <label for="deviceLatitude">Latitude</label>
                            <input type="text" class="form-control" id="deviceLatitude" name="deviceLatitude" placeholder="Latitude">
                        </div>
                        <div class="form-group">
                            <label for="deviceLongitude">Longitude</label>
                            <input type="text" class="form-control" id="deviceLongitude" name="deviceLongitude" placeholder="Longitude">
                        </div>
                        <input type="submit" class="btn btn-primary" id="deviceRegister" name="Register">
                        <input type="reset" class="btn btn-danger" name="Reset">
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['view_device'])): ?>
            <div class="col-lg-8">
                <div class="table-responsive table-hover">
                    <table class="table">                 
                        <thead>    
                        <th>#ID</th>
                        <th>Device Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Status</th>
                        </thead>
                        <?php
                        $sql = "SELECT * from devices where is_active = 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . "<a href=" . 'devices.php?device_id=' . $row['device_number'] . " target='_blank'>" . $row['device_number'] . "</a>" . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['city'] . "</td>";
                                echo "<td>" . $row['state'] . "</td>";
                                echo "<td>" . $row['country'] . "</td>";
                                echo "<td>" . $row['latitude'] . "</td>";
                                echo "<td>" . $row['longitude'] . "</td>";
                                echo customFunctions::getDeviceStatus($row['device_number']);
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['device_id'])): ?>
            <div class="col-lg-12">
                <div class="table-responsive table-hover">
                    <table class="table">                 
                        <thead>    
                        <th>#DEVICE ID</th>
                        <th>TIME</th>
                        <th>DATE</th>
                        <th>INPUT VOLTAGE</th>
                        <th>CURRENT LOAD</th>
                        <th>STATUS</th>
                        <th>LOW CUT SET</th>
                        <th>HIGH CUT SET</th>
                        <th>MESSAGE CODE</th>
                        <th>OVERLOAD SET</th>
                        <th>CREATED</th>
                        </thead>
                        <?php
                        $result = customFunctions::getDeviceData($_GET['device_id']);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['device_id'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['input_voltage'] . "</td>";
                                echo "<td>" . $row['current_load'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['low_cut_set'] . "</td>";
                                echo "<td>" . $row['high_cut_set'] . "</td>";
                                echo "<td>" . $row['message_code'] . "</td>";
                                echo "<td>" . $row['overload_set'] . "</td>";
                                echo "<td>" . $row['created'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No data";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php require_once 'includes/footer.php'; ?>