<?php
$title = "Bookings Info";
require_once("includes/headerClients.php");
include "../db_conn.php";

if (!isset($_GET['infoid'])) {
    echo "No booking ID provided.";
    exit();
}

$id = str_replace('_', ' ', $_GET['infoid']);
?>

<main >
    <body>
        <div>
            <div style="position: relative;">
                <img src="../imgs/bg4.jpg" class="bg-img4 w-100" alt="Background image">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters align-items-end justify-content-start">
                        <div class="col-md-9 ftco-animate pb-5 text-overlay">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb fs-10 fw-bold text-uppercase">
                                    <div class="mr-5">
                                        <a href="index.php" class="text-decoration-none home-link">Home
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                    <a class="text-decoration-none text-light">Booking Info
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Bookings Info</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <div class="container mt-5 mb-5">
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
                        "City" => $row['city']    
                    ];
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-center">Users Details</h3>
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

<?php require_once("includes/footerClients.php"); ?>
