<?php
ob_start();

$title = "Receipt";
require_once("includes/headerUsers.php");
include "../db_conn.php";
require '../vendor/autoload.php';

date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("Y-m-d ");

$invoice_no = uniqid("INV");

if (isset($_GET['bookingid'])) {
    $id = $_GET['bookingid'];

    $sql = "SELECT * FROM cars WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $cars_name = $row['name'];
        $clientname = $row['client_name'];
        $price_string = $row['price'];
    }

    $state = $_SESSION['booking']['state'] ?? null;
    $city = $_SESSION['booking']['city'] ?? null;
    $pickup_date = $_SESSION['booking']['pickup_date'] ?? null;
    $pickup_location = $_SESSION['booking']['pickup_location'] ?? null;
    $drop_date = $_SESSION['booking']['drop_date'] ?? null;
    $drop_location = $_SESSION['booking']['drop_location'] ?? null;

    $days_rented = $_SESSION['payment']['days_rented'] ?? null;
    $total_price = $_SESSION['payment']['total_price'] ?? null;
    $deposit = $_SESSION['payment']['deposit'] ?? null;
    $total = $_SESSION['payment']['total'] ?? null;

    $total_price_rm = 'RM ' . number_format($total_price, 2);
    $deposit_rm = 'RM ' . number_format($deposit, 2);
    $total_rm = 'RM ' . number_format($total, 2);

    $full_name = $_SESSION['info']['full_name'] ?? null;
    $user_name = $_SESSION['info']['user_name'] ?? null;
    $ic_no = $_SESSION['info']['ic_no'] ?? null;
    $driver_no = $_SESSION['info']['driver_no'] ?? null;
    $phone = $_SESSION['info']['phone'] ?? null;
    $email = $_SESSION['info']['email'] ?? null;
    $status = $_SESSION['info']['status'] ?? null;
    $payment_method = $_SESSION['info']['payment_method'] ?? null;

    $stripe_id = $_SESSION['api']['stripe_id'] ?? null;
    
    $sql = "SELECT id FROM bookings ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $latest_id = $row['id'];
    }

    if (!isset($_SESSION['inserted_booking'])) {
        $sql = "INSERT INTO bookings (state, city, full_name, user_name, client_name, email, phone_num, cars_name, ic_no, driver_no, days_rented, deposit, total, status, pickup_location, dropoff_location, pickup_date, dropoff_date, invoice_no, invoice_date, payment_method, stripe_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssssisssssssssss",
            $state,
            $city,
            $full_name,
            $user_name,
            $clientname,
            $email,
            $phone,
            $cars_name,
            $ic_no,
            $driver_no,
            $days_rented,
            $deposit_rm,
            $total_rm,
            $status,
            $pickup_location,
            $drop_location,
            $pickup_date,
            $drop_date,
            $invoice_no,
            $date,
            $payment_method,
            $stripe_id
        );

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['inserted_booking'] = true;
        }
    }
}
?>

<main>
    <div>
        <div style="position: relative;">
            <img src="../imgs/bg4.jpg" class="bg-img3 w-100" alt="Background image">
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
                                <a class="text-decoration-none text-light">Receipt
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </ol>
                        </nav>
                        <h1 class="fst-italic text-capitalize text-white">Receipt</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15"> <span class="badge bg-secondaryb font-size-12 ms-2">Pending</span></h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">Car rental</h2>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1">1016, Jln Sultan Ismail, Bandar Wawasan, 50250 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p>
                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>umarhakimi987@gmail.com</p>
                                <p><i class="uil uil-phone me-1"></i> 011-61310512</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-2"><?php echo htmlspecialchars($full_name) ?></h5>
                                    <p class="mb-1"><?php echo htmlspecialchars($email) ?></p>
                                    <p><?php echo htmlspecialchars($phone) ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#<?php echo $invoice_no ?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p><?php echo $date ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h5 class="font-size-16 mb-3">Pickup and Dropoff Details</h5>
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-1">Pickup Location:</h5>
                                        <p class="mb-3"><?php echo htmlspecialchars($pickup_location) ?></p>
                                        <h5 class="font-size-16 mb-1">Pickup Date:</h5>
                                        <p class="mb-1"><?php echo htmlspecialchars($pickup_date) ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <h5 class="font-size-16 mb-1">Dropoff Location:</h5>
                                        <p class="mb-3"><?php echo htmlspecialchars($drop_location) ?></p>
                                        <h5 class="font-size-16 mb-1">Dropoff Date:</h5>
                                        <p class="mb-1"><?php echo htmlspecialchars($drop_date) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Price (daily)</th>
                                            <th>Days Rented</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1"><?php echo htmlspecialchars($cars_name) ?></h5>
                                                    <p class="text-muted mb-0">Rented by <?php echo htmlspecialchars($clientname) ?></p>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($price_string) ?></td>
                                            <td><?php echo htmlspecialchars($days_rented) ?></td>
                                            <td class="text-end"><?php echo $total_price_rm ?></td>
                                        </tr>

                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                            <td class="text-end"><?php echo $total_price_rm ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Deposit</th>
                                            <td class="border-0 text-end"><?php echo $deposit_rm ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end">
                                                <h6 class="m-0 fw-semibold"><?php echo $total_rm ?></h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                    <form action="../email-receipt.php?bookingid=<?php echo $latest_id ?>" method="POST" class="mt-3" style="display: inline;">
                                        <button type="submit" class="btn btn-primary w-md">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
require_once("includes/footerUsers.php");
?>