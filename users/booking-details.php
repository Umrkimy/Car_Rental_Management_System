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
 
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                            <a class="text-decoration-none home-link" href="booking-price.php?bookingid=<?php echo urlencode($id); ?>">Total
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a class="text-decoration-none text-light">Billing Details
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

<!-- Billing Details Form -->
<div class="container mt-5 text-dark">
        <form action="" method="POST" class="p-4 bg-light border rounded">
            <h2 class="mb-4">Billing Details</h2>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name<span class="text-danger">*</span></label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="driver_license" class="form-label">Driver License Expiry Date (Optional)</label>
                    <input type="date" name="driver_license" id="driver_license" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passport_no" class="form-label">Passport or IC No.<span class="text-danger">*</span></label>
                    <input type="text" name="passport_no" id="passport_no" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="emergency_contact" class="form-label">Emergency Contact (Optional)</label>
                <input type="tel" name="emergency_contact" id="emergency_contact" class="form-control">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="create_account" id="create_account" class="form-check-input">
                <label for="create_account" class="form-check-label">Create an account?</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

</main>

<?php 
ob_end_flush();
require_once("includes/footerUsers.php"); ?>
