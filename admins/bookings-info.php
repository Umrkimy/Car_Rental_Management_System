<?php
$title = "Bookings Info";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

if (!isset($_GET['infoid'])) {
    echo "No booking ID provided.";
    exit();
}

$id = str_replace('_', ' ', $_GET['infoid']);
?>

<main class="mt-5 pt-3">
    <div class="container mt-5 " style="max-width: 100%; padding: 1rem;">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center my-3">Booking Information</h1>
            </div>
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM bookings WHERE id='$id'";
                $result = mysqli_query($conn, $sql);

                if ($result && $row = mysqli_fetch_assoc($result)) {
                    $personalDetails = [
                        "Full Name" => $row['full_name'],
                        "Username" => $row['user_name'],
                        "Email" => $row['email'],
                        "Phone Number" => $row['phone_num'],
                        "IC/Passport No" => $row['ic_no'],
                        "Driver License No" => $row['driver_no']
                    ];

                    $bookingDetails = [
                        "Client Name" => $row['client_name'],
                        "Car Name" => $row['cars_name'],
                        "Status" => $row['status'],
                        "Invoice No" => $row['invoice_no'],
                        "Days Rented" => $row['days_rented'],
                        "Payment Method" => $row['payment_method'],
                        "Total Price" => $row['total'],
                        "Deposit" => $row['deposit'],
                        "Pickup Location" => $row['pickup_location'],
                        "Dropoff Location" => $row['dropoff_location'],
                        "Pickup Date" => $row['pickup_date'],
                        "Dropoff Date" => $row['dropoff_date'],
                        "State" => $row['state'],  
                        "City" => $row['city'],
                        "Stripe ID" => $row['stripe_id']     
                    ];
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-center">Personal Details</h3>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <?php foreach ($personalDetails as $key => $value): ?>
                                        <tr>
                                            <th><?php echo $key; ?></th>
                                            <td><?php echo $value; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-center">Booking Details</h3>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <?php foreach ($bookingDetails as $key => $value): ?>
                                        <tr>
                                            <th><?php echo $key; ?></th>
                                            <td><?php echo $value; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                } else {
                    $errorMessage = $result ? "No booking found with this ID." : "Error fetching booking details: " . mysqli_error($conn);
                    echo "<p class='text-center text-danger'>{$errorMessage}</p>";
                }
                ?>
            </div>
        </div>
    </div>
</main>
