<?php
$title = "Add Booking";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["full_name"]);
    $clientName = trim($_POST["client_name"]);
    $userName = trim($_POST["user_name"]);
    $phoneNum = trim($_POST["phone_num"]);
    $email = trim($_POST["email"]);
    $icNo = trim($_POST["ic_no"]);
    $driverNo = trim($_POST["driver_no"]);
    $carName = trim($_POST["car_name"]);
    $status = trim($_POST["status"]);
    $daysRented = trim($_POST["days_rented"]);
    $payment_method = trim($_POST["payment_method"]);
    $state = trim($_POST["state"]);
    $city = trim($_POST["city"]);
    $totalPrice = "RM " . trim($_POST["total_price"]);
    $deposit = "RM " . trim($_POST["deposit"]);
    $pickupLocation = trim($_POST["pickup_location"]);
    $dropoffLocation = trim($_POST["dropoff_location"]);
    $pickupDate = trim($_POST["pickup_date"]);
    $dropoffDate = trim($_POST["dropoff_date"]);
    $invoice_no = uniqid("INV");

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = date("Y-m-d");

    if (empty($clientName) || empty($carName) || empty($status) || empty($invoice_no)) {
        $message = '<p class="alert alert-danger">Please fill in all required fields.</p>';
    } else {
        $stmt = $conn->prepare("INSERT INTO bookings (full_name, client_name, user_name, phone_num, email, ic_no, driver_no, cars_name, status, invoice_no, days_rented, total, deposit, pickup_location, dropoff_location, pickup_date, dropoff_date, invoice_date, payment_method, state, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssssssssss", $fullName, $clientName, $userName, $phoneNum, $email, $icNo, $driverNo, $carName, $status, $invoice_no, $daysRented, $totalPrice, $deposit, $pickupLocation, $dropoffLocation, $pickupDate, $dropoffDate, $date, $payment_method, $state, $city);
        
        if ($stmt->execute()) {
            $message = '<p class="alert alert-success">Booking added successfully.</p>';
        } else {
            $message = '<p class="alert alert-danger">Failed to add booking. Please try again.</p>';
        }
        $stmt->close();
    }
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
                                <h4>Add Booking</h4>
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
                                <input class="form-control" name="full_name"  placeholder="Full Name"required>
                            </div>
                            <div class="form-group">
                                <label>Client Name*</label>
                                <input class="form-control" name="client_name" placeholder="Client Name" required>
                            </div>

                            <div class="form-group">
                                <label>User Name*</label>
                                <input class="form-control" name="user_name" placeholder="User Name" required>
                            </div>

                            <div class="form-group">
                                <label>Phone Number*</label>
                                <input class="form-control" name="phone_num" type="tel" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group">
                                <label>Email*</label>
                                <input class="form-control" name="email" type="email" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <label>IC No*</label>
                                <input class="form-control" name="ic_no" placeholder="IC Number" required>
                            </div>

                            <div class="form-group">
                                <label>Driver No*</label>
                                <input class="form-control" name="driver_no" placeholder="Driver Number" required>
                            </div>

                            <div class="form-group">
                                <label>Car Name*</label>
                                <input class="form-control" name="car_name" placeholder="Car Name" required>
                            </div>

                            <div class="form-group">
                                <label>Status*</label>
                                <select class="form-control" name="status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Cancelled">Cancelled</option>
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
                                        <input class="form-control" name="days_rented" type="number" placeholder="Days Rented" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Payment Method*</label>
                                    <select class="form-control" name="payment_method" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Online Transaction">Online Transaction</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Price*</label>
                                        <input class="form-control" name="total_price" type="text" step="0.01" placeholder="Total Price" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Deposit*</label>
                                        <input class="form-control" name="deposit" type="text" step="0.01" placeholder="Deposit" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pickup Location*</label>
                                        <input class="form-control" name="pickup_location" placeholder="Pickup Location" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dropoff Location*</label>
                                        <input class="form-control" name="dropoff_location" placeholder="Dropoff Location" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pickup Date*</label>
                                        <input class="form-control" name="pickup_date" type="datetime-local" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Dropoff Date*</label>
                                <input class="form-control" name="dropoff_date" type="datetime-local" required>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Add Booking</button>
                            </div>
                        </form>

                        <div class="mt-3">
                            <a href="bookings.php">
                                << Back to Bookings management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>