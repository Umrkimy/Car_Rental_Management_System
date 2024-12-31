<?php
ob_start();

$title = "Booking Confirmation";
require_once("includes/headerUsers.php");
include "../db_conn.php";

if (isset($_GET['receiptid'])) {
    $id = $_GET['receiptid'];

    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $cars_name = $row['cars_name'];
        $clientname = $row['client_name'];
        $full_name = $row['full_name'];
        $email = $row['email'];
        $phone = $row['phone_num'];
        $invoice_no = $row['invoice_no'];
        $date = $row['invoice_date'];
        $days_rented = $row['days_rented'];
        $deposit_rm = $row['deposit'];
        $total = $row['total'];
        $status = $row['status'];
        $stripe_id = $row['stripe_id'];
        $refund_id = $row['refund_id'];
        $refund_date = $row['refund_date'];
        $refund_total = $row['refund_total'];

        $pickup_location = $row['pickup_location'];
        $pickup_date = $row['pickup_date'];
        $dropoff_location = $row['dropoff_location'];
        $dropoff_date = $row['dropoff_date'];

        $total_without_rm = (float)str_replace(['RM', ',', ' '], '', $total);
        $deposit_without_rm = (float)str_replace(['RM', ',', ' '], '', $deposit_rm);
        $refund_without_rm = (float)str_replace(['RM', ',', ' '], '', $refund_total);

        $price_withour_rm = $total_without_rm / $days_rented;
        $total_price = $total_without_rm - $deposit_without_rm;

        $price = 'RM ' . number_format($price_withour_rm, 2);
        $total_price_rm = 'RM ' . number_format($total_price, 2);
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
                                <a class="text-decoration-none text-light">Refunded Receipt
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </ol>
                        </nav>
                        <h1 class="fst-italic text-capitalize text-white">Refunded Receipt</h1>
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
                            <h4 class="float-end font-size-15">
                                <span class="badge <?php if ($status === 'Cancelled') {
                                  echo 'bg-danger';
                                } elseif ($status === 'Pending') {
                                echo 'bg-secondary';
                                } elseif ($status === 'Refunded') {
                                echo 'bg-primary';
                                } else {
                                echo 'bg-success';
                                    } ?> font-size-12 ms-2"><?php echo htmlspecialchars($status); ?></span>
                            </h4>
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
                                        <h5 class="font-size-15 mb-1">Refunded ID:</h5>
                                        <p>#<?php echo $refund_id ?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Refund Date:</h5>
                                        <p><?php echo htmlspecialchars($refund_date) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Item</th>
                                        <th>Price (daily)</th>
                                        <th>Days Rented</th>
                                        <th>Deposit</th>
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
                                        <td><?php echo htmlspecialchars($price) ?></td>
                                        <td><?php echo htmlspecialchars($days_rented) ?></td>
                                        <td><?php echo htmlspecialchars($deposit_rm) ?></td>
                                        <td class="text-end"><?php echo $total_price_rm ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row" colspan="5" class="text-end">Total</th>
                                        <td class="text-end"><?php echo $total ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-end">Sub total</th>
                                        <td class="border-0 text-end"><?php echo $total_price_rm ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-end">Refunded Total</th>
                                        <td class="border-0 text-end">
                                            <h6 class="m-0 fw-semibold"><?php echo $refund_total ?></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                <form action="../email-receipt.php?bookingid=<?php echo $id ?>" method="POST" class="mt-3" style="display: inline;">
                                    <button type="submit" name="send_receipt" class="btn btn-primary">
                                        <i class="fa fa-envelope"></i> Send Receipt
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once("includes/footerUsers.php"); ?>

