<?php
$title = "Update Booking";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$id = @$_GET['updateid'];
$message = "";
$clientName = $userName = $phoneNum = $email = $icNo = $driverNo = $carName = $status = $invoiceNo = $daysRented = $paymentMethod = $totalPrice = $deposit = $pickupLocation = $dropoffLocation = $pickupDate = $dropoffDate = "";

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fullName = $row['full_name'];
        $clientName = $row['client_name'];
        $userName = $row['user_name'];
        $phoneNum = $row['phone_num'];
        $email = $row['email'];
        $icNo = $row['ic_no'];
        $driverNo = $row['driver_no'];
        $carName = $row['cars_name'];
        $status = $row['status'];
        $invoiceNo = $row['invoice_no'];
        $daysRented = $row['days_rented'];
        $paymentMethod = $row['payment_method'];
        $totalPrice = $row['total'];
        $deposit = $row['deposit'];
        $pickupLocation = $row['pickup_location'];
        $dropoffLocation = $row['dropoff_location'];
        $pickupDate = $row['pickup_date'];
        $dropoffDate = $row['dropoff_date'];
    } else {
        $message = '<p class="alert alert-danger">Booking not found.</p>';
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $invoiceNo = uniqid("INV");
    $fullName = trim($_POST["full_name"]);
    $clientName = trim($_POST["client_name"]);
    $userName = trim($_POST["user_name"]);
    $phoneNum = trim($_POST["phone_num"]);
    $email = trim($_POST["email"]);
    $icNo = trim($_POST["ic_no"]);
    $driverNo = trim($_POST["driver_no"]);
    $carName = trim($_POST["car_name"]);
    $status = trim($_POST["status"]);
    $state = trim($_POST["state"]);
    $city = trim($_POST["city"]);
    $daysRented = trim($_POST["days_rented"]);
    $paymentMethod = trim($_POST["payment_method"]);
    $totalPrice = trim($_POST["total_price"]);
    $deposit = trim($_POST["deposit"]);
    $pickupLocation = trim($_POST["pickup_location"]);
    $dropoffLocation = trim($_POST["dropoff_location"]);
    $pickupDate = trim($_POST["pickup_date"]);
    $dropoffDate = trim($_POST["dropoff_date"]);

    $stmt = $conn->prepare("UPDATE bookings SET city = ?,state = ?,full_name = ?, client_name = ?, user_name = ?, phone_num = ?, email = ?, ic_no = ?, driver_no = ?, cars_name = ?, status = ?, invoice_no = ?, days_rented = ?, total = ?, deposit = ?, pickup_location = ?, dropoff_location = ?, pickup_date = ?, dropoff_date = ?, payment_method = ? WHERE id = ?");
    $stmt->bind_param("ssssssssssssssssssssi", $state, $city, $fullName, $clientName, $userName, $phoneNum, $email, $icNo, $driverNo, $carName, $status, $invoiceNo, $daysRented, $totalPrice, $deposit, $pickupLocation, $dropoffLocation, $pickupDate, $dropoffDate, $paymentMethod, $id);

    if ($stmt->execute()) {
        $message = '<p class="alert alert-success">Booking updated successfully.</p>';
    } else {
        $message = '<p class="alert alert-danger">Failed to update booking. Please try again.</p>';
    }
    $stmt->close();
}
?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <i class="bi bi-file-earmark" style="font-size: 100px;"></i>
                                <h4>Update Booking</h4>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <?= $message ?>
                            </div>
                        </div>

                        <form action="" method="post">
                        <div class="form-group">
                                <label>Full Name*</label>
                                <input class="form-control" name="full_name" value="<?= htmlspecialchars($fullName) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Client Name*</label>
                                <input class="form-control" name="client_name" value="<?= htmlspecialchars($clientName) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>User Name*</label>
                                <input class="form-control" name="user_name" value="<?= htmlspecialchars($userName) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Phone Number*</label>
                                <input class="form-control" name="phone_num" type="tel" value="<?= htmlspecialchars($phoneNum) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Email*</label>
                                <input class="form-control" name="email" type="email" value="<?= htmlspecialchars($email) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>IC No*</label>
                                <input class="form-control" name="ic_no" value="<?= htmlspecialchars($icNo) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Driver No*</label>
                                <input class="form-control" name="driver_no" value="<?= htmlspecialchars($driverNo) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Car Name*</label>
                                <input class="form-control" name="car_name" value="<?= htmlspecialchars($carName) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Status*</label>
                                <select class="form-control" name="status" required>
                                    <option value="Pending" <?= $status == "Pending" ? "selected" : "" ?>>Pending</option>
                                    <option value="Confirmed" <?= $status == "Confirmed" ? "selected" : "" ?>>Confirmed</option>
                                    <option value="Cancelled" <?= $status == "Cancelled" ? "selected" : "" ?>>Cancelled</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State*</label>
                                        <input class="form-control" name="state" placeholder="State" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City*</label>
                                        <input class="form-control" name="city" placeholder="City" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Days Rented*</label>
                                        <input class="form-control" name="days_rented" type="number" value="<?= htmlspecialchars($daysRented) ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Payment Method*</label>
                                    <select class="form-control" name="payment_method" required>
                                        <option value="Pending" <?= $paymentMethod == "Pending" ? "selected" : "" ?>>Pending</option>
                                        <option value="Online Transaction" <?= $paymentMethod == "Online Transaction" ? "selected" : "" ?>>Online Transaction</option>
                                        <option value="Cash" <?= $paymentMethod == "Cash" ? "selected" : "" ?>>Cash</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Price*</label>
                                        <input class="form-control" name="total_price" type="text" step="0.01" value="<?= htmlspecialchars($totalPrice) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Deposit*</label>
                                        <input class="form-control" name="deposit" type="text" step="0.01" value="<?= htmlspecialchars($deposit) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pickup Location*</label>
                                        <input class="form-control" name="pickup_location" value="<?= htmlspecialchars($pickupLocation) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dropoff Location*</label>
                                        <input class="form-control" name="dropoff_location" value="<?= htmlspecialchars($dropoffLocation) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pickup Date*</label>
                                        <input class="form-control" name="pickup_date" type="datetime-local" value="<?= htmlspecialchars($pickupDate) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Dropoff Date*</label>
                                <input class="form-control" name="dropoff_date" type="datetime-local" value="<?= htmlspecialchars($dropoffDate) ?>" required>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Update Booking</button>
                            </div>
                        </form>

                        <div class="mt-3">
                            <a href="bookings.php"><< Back to Bookings Management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
