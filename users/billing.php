<?php
$title = 'Billing';
require_once("includes/headerUsers.php");
include "../db_conn.php";

$message = "";

$stmt = $conn->prepare("SELECT total, deposit, refund_total FROM bookings WHERE user_name = ?");
$stmt->bind_param("s", $usernametop);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$deposit = 0;
$refund = 0;
$formatted_total = 'RM 0.00';
$formatted_deposit = 'RM 0.00';
$formatted_refund = 'RM 0.00';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $price_string = $row['total'];
        $total_without_rm = (float)str_replace(',', '', str_replace('RM', '', $price_string));
        $total += $total_without_rm;
        
        $deposit_string = $row['deposit'];
        $deposit_without_rm = (float)str_replace(',', '', str_replace('RM', '', $deposit_string));
        $deposit += $deposit_without_rm;

        $refund_string = $row['refund_total'];
        $refund_without_rm = (float)str_replace(',', '', str_replace('RM', '', $refund_string));
        $refund += $refund_without_rm;
    }
    $formatted_total = 'RM ' . number_format($total, 2);
    $formatted_deposit = 'RM ' . number_format($deposit, 2);
    $formatted_refund = 'RM ' . number_format($refund, 2);
}

if (isset($idtop) && $idtop) {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND status = ?");
    $pendingStatus = "Pending";
    $stmt->bind_param("is", $idtop, $pendingStatus);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = '<p class="alert alert-warning">Your booking is pending confirmation from the client. You may cancel up to one day before the pickup date to receive a full refund. After that, the deposit will be non-refundable.</p>';
    }
}
?>

<main>

    <head>
        <link href="includes/css/billing.css" rel="stylesheet" />
    </head>

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
                                    <a class="text-decoration-none text-light">Billing
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Billing</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xl px-4 mt-4 mb-5">
            <nav class="nav nav-borders">
                <a class="nav-link ms-0" href="profile.php">Profile</a>
                <a class="nav-link active" href="billing.php">Billing</a>
                <a class="nav-link" href="settings.php">Settings</a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-primary">
                        <div class="card-body">
                            <div class="small text-muted">Total Amount</div>
                            <div class="h3"><?php echo $formatted_total ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-secondary">
                        <div class="card-body">
                            <div class="small text-muted">Deposit</div>
                            <div class="h3"><?php echo $formatted_deposit ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-success">
                        <div class="card-body">
                            <div class="small text-muted">Total Refunded</div>
                            <div class="h3 d-flex align-items-center"><?php echo $formatted_refund ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Billing History</div>
                <?= $message ?>
                <div class="card-body p-0">
                    <div class="table-responsive table-billing-history">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="border-gray-200" scope="col">Invoice No</th>
                                    <th class="border-gray-200" scope="col">Car</th>
                                    <th class="border-gray-200" scope="col">Days rented</th>
                                    <th class="border-gray-200" scope="col">Pickup Date & Time</th>
                                    <th class="border-gray-200" scope="col">Receipt Created</th>
                                    <th class="border-gray-200" scope="col">Amount</th>
                                    <th class="border-gray-200" scope="col">Status</th>
                                    <th class="border-gray-200" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $stmt = $conn->prepare("SELECT id, invoice_no, cars_name, days_rented, invoice_date, total, status,pickup_date FROM bookings WHERE user_name = ?");
                            $stmt->bind_param("s", $usernametop);
                            $stmt->execute();
                            $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        echo '<tr>
                                                <td>#' . htmlspecialchars($row['invoice_no']) . '</td>
                                                <td>' . htmlspecialchars($row['cars_name']) . '</td>
                                                <td>' . htmlspecialchars($row['days_rented']) . ' </td>
                                                <td>' . htmlspecialchars($row['pickup_date']) . ' </td>
                                                <td>' . htmlspecialchars($row['invoice_date']) . '</td>
                                                <td>' . htmlspecialchars(($row['total'])) . '</td>
                                                   <td>
            <span class="badge bg-' .
                                            ($row['status'] === 'Confirmed' ? 'info' : ($row['status'] === 'Cancelled' ? 'danger' : ($row['status'] === 'Completed' ? 'success' : ($row['status'] === 'Refunded' ? 'primary' : 'secondary'))))
                                            . '">' . htmlspecialchars($row['status']) . '</span>
        </td>
                                                <td >
                                                <a title="Receipt" href="billing-receipt.php?receiptid=' . $id . '" class=""><i class="bi bi-eye-fill text-success"></i></a>';
                                        if ($row['status'] === 'Pending') {
                                            echo ' <a title="Cancel Booking " href="cancel-booking.php?invoiceid=' . $id . '" class="ms-3 "><i class="bi bi-file-excel-fill text-danger"></i></a>';
                                        }
                                        if ($row['status'] === 'Confirmed') {
                                            echo ' <a title="Cancel Booking" href="cancel-booking.php?invoiceid=' . $id . '" class="ms-3 "><i class="bi bi-file-excel-fill text-danger"></i></a>';
                                        }
                                        if ($row['status'] === 'Refunded') {
                                            echo ' <a title="Refunded Receipt" href="billing-refunded.php?receiptid=' . $id . '" class="ms-3"><i class="bi bi-eye-fill text-primary"></i></a>';
                                        }
                                        if ($row['status'] === 'Cancelled') {
                                            echo ' <a title="Refunded Receipt" href="billing-refunded.php?receiptid=' . $id . '" class="ms-3"><i class="bi bi-eye-fill text-primary"></i></a>';
                                        }
                                        echo '
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">No billing history available</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

</main>

<?php
require_once("includes/footerUsers.php");
?>