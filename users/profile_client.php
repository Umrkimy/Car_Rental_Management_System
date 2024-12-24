<?php
$title = 'Profile Client';
require_once("includes/headerUsers.php");
include "../db_conn.php";

$message = "";

$pickup = isset($_GET['pickup']) ? $_GET['pickup'] : null;
$dropoff = isset($_GET['dropoff']) ? $_GET['dropoff'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$seats = isset($_GET['seats']) ? (int) $_GET['seats'] : null;

if (isset($_GET['clientname'])) {
    $name = $_GET['clientname'];

    $stmt = $conn->prepare("SELECT * FROM clients WHERE client_name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['full_name'];
        $email = $row['email'];
        $phonenum = $row['phone_num'];
        $clientname = $row['client_name'];
        $address = $row['address'];
        $ic_no = $row['ic_no'];
        $driver_no = $row['driver_no'];
        $date = $row['date'];
    } else {
        $message = '<p class="alert alert-danger">Client not found.</p>';
    }
    $stmt->close();
} else {
    $message = '<p class="alert alert-danger">Invalid Client ID.</p>';
}
?>

<main>

    <head>
        <link href="includes/css/profile_client.css" rel="stylesheet" />
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
                                    <a class="text-decoration-none text-light">Profile
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Profile</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="main-body">
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Client Profile</li>
                    </ol>
                </nav>

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo htmlspecialchars($clientname); ?></h4>
                                        <p class="text-muted font-size-sm"><?php echo htmlspecialchars($address); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo htmlspecialchars($clientname); ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo htmlspecialchars($email); ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo htmlspecialchars($phonenum); ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo htmlspecialchars($address); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Cars</h5>
                                <div class="">

                                    <?php
                                    $itemsPerPage = 4;
                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $itemsPerPage;

                                    $clientname = $conn->real_escape_string($clientname);

                                    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM cars WHERE client_name = ? LIMIT ? OFFSET ?";
                                    $params = [$clientname, $itemsPerPage, $offset];
                                    $types = "sii";

                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    $totalRowsResult = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
                                    $totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];
                                    $totalPages = ceil($totalRows / $itemsPerPage);
                                    ?>

                                    <div class="container text-dark mt-5">
                                        <div class="row">
                                            <?php
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $name = str_replace(' ', '_', $row['name']);
                                                    $id = $row['id'];
                                                    $isAvailable = true;

                                                    if ($pickup && $dropoff) {
                                                        $availabilityQuery = "
                    SELECT * FROM bookings 
                    WHERE cars_name = ? 
                    AND (
                        (? BETWEEN pickup_date AND dropoff_date) OR 
                        (? BETWEEN pickup_date AND dropoff_date) OR
                        (pickup_date BETWEEN ? AND ?) OR 
                        (dropoff_date BETWEEN ? AND ?)
                    )";

                                                        $availabilityStmt = mysqli_prepare($conn, $availabilityQuery);
                                                        mysqli_stmt_bind_param($availabilityStmt, "sssssss", $row['name'], $pickup, $dropoff, $pickup, $dropoff, $pickup, $dropoff);
                                                        mysqli_stmt_execute($availabilityStmt);
                                                        $availabilityResult = mysqli_stmt_get_result($availabilityStmt);

                                                        if ($availabilityResult && mysqli_num_rows($availabilityResult) > 0) {
                                                            $isAvailable = false;
                                                        }
                                                    }

                                                    if ($isAvailable) {
                                                        echo '
                    <div class="col-md-6 col-sm-12 mb-4">
    <div class="card border-0 shadow-sm hover-shadow h-100">
        <div class="row g-0">
            <div class="col-md-12">
                <img src="' . htmlspecialchars($row['image']) . '" class="img-fluid rounded-start" alt="' . htmlspecialchars($row['name']) . '" style="height: 200px; object-fit: cover;">
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                    <p class="text-muted mb-1">Rented by: <strong>' . htmlspecialchars($row['client_name']) . '</strong> </p>
                    <p class="mb-1">Price (Daily): <strong>' . htmlspecialchars($row['price']) . ' </strong></p>
                    <p class="mb-1">Seats: <strong>' . htmlspecialchars($row['seats']) . ' </strong></p>
                    <p class="mb-1">Transmission: <strong>' . htmlspecialchars($row['trans']) . '</strong></p>
                    <p class="mb-1">State: <strong>' . htmlspecialchars($row['state']) . '</strong></p>
                    <p class="mb-1">City: <strong>' . htmlspecialchars($row['city']) . '</strong></p>
                    <a href="booking.php?bookingid=' . urlencode($id) . '" class="btn btn-success text-white shadow-none mt-2">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>';
                                                    }
                                                }
                                            } else {
                                                echo '<p class="text-center">No Cars available at the moment.</p>';
                                            }
                                            ?>


                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                                    <?php if ($page > 1): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">Previous</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                            <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
                                                        </li>
                                                    <?php endfor; ?>

                                                    <?php if ($page < $totalPages): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">Next</a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </nav>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</main>

<?php
require_once("includes/footerUsers.php");
?>