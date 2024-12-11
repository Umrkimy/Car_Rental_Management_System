<?php
$title = 'Billing';
require_once("includes/headerUsers.php");
include "../db_conn.php";
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
                            <div class="small text-muted">Current monthly bill</div>
                            <div class="h3">$20.00</div>
                            <a class="text-arrow-icon small" href="#!">
                                Switch to yearly billing
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-secondary">
                        <div class="card-body">
                            <div class="small text-muted">Next payment due</div>
                            <div class="h3">July 15</div>
                            <a class="text-arrow-icon small text-secondary" href="#!">
                                View payment history
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-success">
                        <div class="card-body">
                            <div class="small text-muted">Current plan</div>
                            <div class="h3 d-flex align-items-center">Freelancer</div>
                            <a class="text-arrow-icon small text-success" href="#!">
                                Upgrade plan
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Billing History</div>
                <div class="card-body p-0">
                    <div class="table-responsive table-billing-history">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="border-gray-200" scope="col">Invoice No</th>
                                    <th class="border-gray-200" scope="col">Car</th>
                                    <th class="border-gray-200" scope="col">Days rented</th>
                                    <th class="border-gray-200" scope="col">Receipt Date</th>
                                    <th class="border-gray-200" scope="col">Amount</th>
                                    <th class="border-gray-200" scope="col">Status</th>
                                    <th class="border-gray-200" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $conn->prepare("SELECT id, invoice_no, cars_name, days_rented, invoice_date, total, status FROM bookings WHERE user_name = ?");
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
                                                <td>' . htmlspecialchars($row['invoice_date']) . '</td>
                                                <td>' . htmlspecialchars(($row['total'])) . '</td>
                                                <td>
                                                <span class="badge bg-' .
                                                    ($row['status'] === 'Paid' ? 'success' : ($row['status'] === 'Cancelled' ? 'danger' : 'secondary'))
                                                . '">' . htmlspecialchars($row['status']) . '</span>
                                                </td>
                                                <td >
                                                <a href="billing-receipt.php?receiptid=' . $id . '" class=""><i class="bi bi-three-dots text-secondary"></i></a>
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