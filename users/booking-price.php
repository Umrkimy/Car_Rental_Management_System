<?php
ob_start();

$title = "Booking Confirmation";
require_once("includes/headerUsers.php");
include "../db_conn.php";

if (isset($_GET['bookingid'])) {
    $id = $_GET['bookingid'];

    $sql = "SELECT * FROM cars WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];

        $price_string = $row['price']; 
        $price = (float)str_replace('RM', '', $price_string); 

        $image = $row['image'];
    }

    $pickup_date = isset($_SESSION['booking']['pickup_date']) ? $_SESSION['booking']['pickup_date'] : null;
    $drop_date = isset($_SESSION['booking']['drop_date']) ? $_SESSION['booking']['drop_date'] : null;
 
    if ($pickup_date && $drop_date) {
        $pickup_date_obj = new DateTime($pickup_date);
        $drop_date_obj = new DateTime($drop_date);

        $interval = $pickup_date_obj->diff($drop_date_obj);
        $days_rented = $interval->days;

        $total_price = $price * $days_rented;
        $deposit = $total_price * 0.1;
        $total = $total_price + $deposit;

        $_SESSION['payment']['days_rented'] = $days_rented;
        $_SESSION['payment']['total_price'] = $total_price;
        $_SESSION['payment']['deposit'] = $deposit;
        $_SESSION['payment']['total'] = $total;
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
                            <a class="text-decoration-none home-link" href="booking.php?bookingid=<?php echo urlencode($id); ?>">Booking
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a class="text-decoration-none text-light">Total
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </ol>
                    </nav>
                    <h1 class="fst-italic text-capitalize text-white">Booking</h1>
                </div>
            </div>
        </div>
</div>
</div>

<div class="card shadow-lg mt-4 mb-5" style="width: 100%; max-width: 700px; margin: 0 auto;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 "><?php echo $name; ?></h5>
    </div>
    <div class="card-body">
        <div class="d-flex flex-column align-items-center">
            <img src="<?php echo $image; ?>" alt="Car Image" style="width: 400px;" />
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">QTY</th>
                        <th scope="col">RATE</th>
                        <th scope="col">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $days_rented; ?> Days</td>
                        <td>RM <?php echo $price; ?></td>
                        <td>RM <?php echo $total_price; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between w-100 px-2">
                <strong>Rental Charges Rate:</strong>
                <span>RM <?php echo $total_price; ?></span>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between">
            <strong>Security Deposit:</strong>
            <span>RM <?php echo $deposit; ?></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <strong>Estimated Total:</strong>
            <span class="fw-bold text-decoration-none">RM<?php echo $total; ?></span>
        </div>
        <form action="booking-details.php?bookingid=<?php echo $id ?>" method="POST" class="mt-3">
            <button type="submit" class="btn btn-warning w-100">Confirm Booking</button>
        </form>
    </div>
</div>
</main>

<?php 
ob_end_flush();
require_once("includes/footerUsers.php"); ?>
