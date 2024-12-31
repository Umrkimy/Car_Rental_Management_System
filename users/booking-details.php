<?php
ob_start();

$title = "Booking Confirmation";
require_once("includes/headerUsers.php");
include "../db_conn.php";

if (isset($_GET['bookingid'])) {
    $id = $_GET['bookingid'];

    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usernametop);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
        $phonenum = $row['phone_num'];
        $fullname = $row['full_name'];
        $email = $row['email'];
        $ic_no = $row['ic_no'];
        $driver_no = $row['driver_no'];
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

    <div class="container mt-5 text-dark">
        <form action="../checkout.php?bookingid=<?php echo $id ?>" method="POST" class="p-4 bg-light border rounded">
            <h2 class="mb-4">Billing Details</h2>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name<span class="text-danger">*</span></label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="<?= htmlspecialchars($fullname) ?>" required>
            </div>

            <div class="mb-3">
                <label for="ic_no" class="form-label">Passport or IC No.<span class="text-danger">*</span></label>
                <input type="text" name="ic_no" id="ic_no" class="form-control" value="<?= htmlspecialchars($ic_no) ?>" required>
            </div>

            <div class="mb-3">
                <label for="driver_no" class="form-label">Driver License No.<span class="text-danger">*</span></label>
                <input type="text" name="driver_no" id="driver_no" class="form-control" value="<?= htmlspecialchars($driver_no) ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="tel" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($phonenum) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="mb-4">
                <label for="user_name" class="form-label">Username<span class="text-danger">*</span></label>
                <input type="text" name="user_name" id="user_name" class="form-control" value="<?= htmlspecialchars($user_name) ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Payment Method<span class="text-danger">*</span></label><br>
                <input type="radio" id="online" name="payment_method" value="Online Transaction" required>
                <label for="online">Online Transaction</label><br>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>

</main>

<?php
ob_end_flush();
require_once("includes/footerUsers.php"); ?>