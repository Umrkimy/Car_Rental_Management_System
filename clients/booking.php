<?php
$title = "Manage Bookings";
require_once("includes/headerClients.php");
include "../db_conn.php";

$message = "";

if (isset($idtop) && $idtop) {
    $stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->bind_param("i", $idtop);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
    }

    if ($status === "Unverified") {
        $message = '<p class="alert alert-warning">You need to verify your account in profile page to manage bookings.</p>';
    } else if ($status === "Pending") {
        $message = '<p class="alert alert-warning">Your account is under verification. It usually takes one day.</p>';
    } else if ($status === "Rejected") {
        $message = '<p class="alert alert-danger">Your account has been rejected from admins. please reverify your your account to be verified.</p>';
    }
}
?>

<main>

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
                                    <a class="text-decoration-none text-light">Bookings Manage
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Bookings Manage</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="card-body mt-5 mb-5">
            <div class="container mt-5 mb-5">
                <div class="card shadow-lg">
                <div class="card-header ">
                <h1 class="text-center my-3">Booking Information</h1>
            </div>
                    <div class="card-body">
                        <?= $message ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Invoice</th>
                                        <th>User Name</th>
                                        <th>Car Name</th>
                                        <th>Pickup Date</th>
                                        <th>Drop Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($clientnametop)) {
                                        $sql = "SELECT * FROM bookings WHERE client_name = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $clientnametop);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $invoice = $row['invoice_no'];
                                                $username = htmlspecialchars($row['user_name']);
                                                $carname = htmlspecialchars($row['cars_name']);
                                                $startdate = $row['pickup_date'];
                                                $enddate = $row['dropoff_date'];
                                                $status = $row['status'];

                                                echo "<tr>
                                                    <td>$invoice</td>
                                                    <td>$username</td>
                                                    <td>$carname</td>
                                                    <td>$startdate</td>
                                                    <td>$enddate</td>
                                                    <td>" . ucfirst($status) . "</td>
                                                    <td>
                                                        <a title='View' href='booking-info.php?infoid=$id' class='ms-3'><i class='text-primary bi bi-eye-fill'></i></a>";
                                                if ($status === 'Confirmed') {
                                                    echo "<a title='Cancel Booking' href='booking-cancel.php?cancelid=$id' class='ms-3'><i class='bi bi-file-excel-fill text-danger'></i></a>";
                                                }
                                                echo "</td>
                                                </tr>";
                                            }
                                        } else {
                                            echo '<tr><td colspan="7">No pending bookings found.</td></tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-body mt-5">
                    <div class="container mb-4">
        <h2 class="text-center text-dark">Pending Bookings for Clients</h2>
        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Invoice</th>
                                        <th>User Name</th>
                                        <th>Car Name</th>
                                        <th>Pickup Date</th>
                                        <th>Drop Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($clientnametop)) {
                                        $sql = "SELECT * FROM bookings WHERE status = 'Pending' AND client_name = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $clientnametop);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $invoice = $row['invoice_no'];
                                                $username = htmlspecialchars($row['user_name']);
                                                $carname = htmlspecialchars($row['cars_name']);
                                                $startdate = $row['pickup_date'];
                                                $enddate = $row['dropoff_date'];
                                                $status = $row['status'];

                                                echo '<tr>
                                                    <td>' . $invoice . '</td>
                                                    <td>' . $username . '</td>
                                                    <td>' . $carname . '</td>
                                                    <td>' . $startdate . '</td>
                                                    <td>' . $enddate . '</td>
                                                    <td>' . ucfirst($status) . '</td>
                                                    <td>
                                                        <a title="Confirm" href="booking-confirm.php?confirmid=' . $id . '" class="ms-3"><i class="text-success bi bi-check-circle-fill"></i></a>
                                                        <a title="Cancel" href="booking-cancel.php?cancelid=' . $id . '" class="ms-3"><i class="text-danger bi bi-file-excel-fill"></i></a>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="7">No pending bookings found.</td></tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>

<?php require_once("includes/footerClients.php"); ?>
