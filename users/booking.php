<?php
ob_start();

if (!isset($_SESSION['booking'])) {
    $_SESSION['booking'] = [];
}

$title = "Booking";
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
        $state = $row['state'];
        $city = $row['city'];
        $cars_name = $row['name'];
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['pickup_location']) && !empty($_POST['pickup_date']) && !empty($_POST['drop_location']) && !empty($_POST['drop_date'])) {
        $pickup_date = $_POST['pickup_date'];
        $drop_date = $_POST['drop_date'];

        unset($_SESSION['booking']['state']);
        unset($_SESSION['booking']['city']);
        unset($_SESSION['booking']['pickup_location']);
        unset($_SESSION['booking']['pickup_date']);
        unset($_SESSION['booking']['drop_location']);
        unset($_SESSION['booking']['drop_date']);

        unset($_SESSION['payment']['days_rented']);
        unset($_SESSION['payment']['total_price']);
        unset($_SESSION['payment']['deposit']);
        unset($_SESSION['payment']['total']);

        unset($_SESSION['info']['full_name']);
        unset($_SESSION['info']['user_name']);
        unset($_SESSION['info']['ic_no']);
        unset($_SESSION['info']['driver_no']);
        unset($_SESSION['info']['phone']);
        unset($_SESSION['info']['email']);
        unset($_SESSION['info']['status']);

            if (strtotime($pickup_date) >= strtotime($drop_date)) {
                $error_message = "Pick-up date and time must be earlier than drop date and time.";
            } else {

                $check_sql = "SELECT * FROM bookings 
                          WHERE cars_name = ? 
                          AND status != 'cancelled' 
                          AND (pickup_date < ? AND dropoff_date > ?)";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "sss", $cars_name, $drop_date, $pickup_date);
                mysqli_stmt_execute($check_stmt);
                $check_result = mysqli_stmt_get_result($check_stmt);
    
                if (mysqli_num_rows($check_result) > 0) {
                    $error_message = "The selected car is already booked for the chosen dates. Please select a different time.";
                } else {
    
                    $_SESSION['booking'] = [
                        'state' => $_POST['state'],
                        'city' => $_POST['city'],
                        'pickup_location' => $_POST['pickup_location'],
                        'pickup_date' => $pickup_date,
                        'drop_location' => $_POST['drop_location'],
                        'drop_date' => $drop_date,
                    ];
    
                    header("Location: booking-price.php?bookingid=" . $id);
                    exit();
                }
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
                            <a class="text-decoration-none text-light">Booking
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

<div class="container mt-3">
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
</div>

<div class="container mt-3">
    <form action="" method="POST">
        <div class="row">
           
        <div class="col-12 mb-4 text-dark">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" id="state" name="state" placeholder="State" class="form-control" value="<?php echo htmlspecialchars($state); ?>" readonly style="background-color: #e9ecef;">
            </div>
            <div class="col-md-6 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" name="city" placeholder="City" class="form-control" value="<?php echo htmlspecialchars($city); ?>" readonly style="background-color: #e9ecef;">
            </div>
        </div>
    
</div>

            <div class="col-12 mb-4 text-dark">
                <h5 class="text-uppercase text-dark">Pick Up</h5>
                <div class="border border-warning p-4 rounded">
                    <div class="mb-3">
                        <label for="pickup-location" class="form-label">Place to pick up the car*</label>
                        <input type="text" id="pickup-location" name="pickup_location" placeholder="Location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pickup-date" class="form-label">Pick-Up Date/Time*</label>
                        <input type="datetime-local" id="pickup-date" name="pickup_date" class="form-control" required>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4 text-dark">
                <h5 class="text-uppercase fw-bold text-dark">Return</h5>
                <div class="border border-warning p-4 rounded">
                    <div class="mb-3">
                        <label for="drop-location" class="form-label">Place to drop the car*</label>
                        <input type="text" id="drop-location" name="drop_location" placeholder="Location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="drop-date" class="form-label">Drop Date/Time*</label>
                        <input type="datetime-local" id="drop-date" name="drop_date" class="form-control" required>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-5">
                <button type="submit" class="btn btn-warning w-100 text-uppercase fw-bold">Continue Reservation </button>   
            </div>
        </div>
    </form>
</div>
</main>

<?php 
ob_end_flush();
require_once("includes/footerUsers.php"); ?>
