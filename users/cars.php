<?php
$title = "Cars";
require_once("includes/headerUsers.php");
include "../db_conn.php";

$pickup = isset($_GET['pickup']) ? $_GET['pickup'] : null;
$dropoff = isset($_GET['dropoff']) ? $_GET['dropoff'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$seats = isset($_GET['seats']) ? (int) $_GET['seats'] : null;
?>

<main>

    <body>
        <div>
            <div style="position: relative;">
                <img src="../imgs/bg4.jpg" class="bg-img2 w-100" alt="Background image">
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
                                    <a class="text-decoration-none text-light">Cars
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Cars</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-dark mt-5">
            <div class="row">
                <div class="col-lg-3 mb-5">
                    <div class="bg-white rounded shadow p-3">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse show" id="filterDropdown">
                            <form method="GET" action="">
                                <div class="mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search Cars" value="<?php echo htmlspecialchars($search); ?>">
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Pick-up date</label>
                                        <input type="date" name="pickup" class="form-control shadow-none" value="<?php echo htmlspecialchars($pickup); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Drop-off date</label>
                                        <input type="date" name="dropoff" class="form-control shadow-none" value="<?php echo htmlspecialchars($dropoff); ?>">
                                    </div>
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">Cars Specs</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Seats</label>
                                        <input type="number" name="seats" class="form-control shadow-none" value="<?php echo htmlspecialchars($seats); ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-dark w-100">Check</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">

                    <?php
                    $itemsPerPage = 6;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $itemsPerPage;

                    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM cars WHERE 1=1";
                    $params = [];
                    $types = "";

                    if ($search) {
                        $sql .= " AND (id LIKE ? OR name LIKE ?)";
                        $params[] = "%$search%";
                        $params[] = "%$search%";
                        $types .= "ss";
                    }

                    if ($seats) {
                        $sql .= " AND seats >= ?";
                        $params[] = $seats;
                        $types .= "i";
                    }

                    $sql .= " LIMIT ? OFFSET ?";
                    $params[] = $itemsPerPage;
                    $params[] = $offset;
                    $types .= "ii";

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
            <div class="col-md-4 col-sm-6 mb-4 ">
                <div class="card border-0 shadow-sm hover-shadow h-100">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img src="' . htmlspecialchars($row['image']) . '" class="img-fluid rounded-start" alt="' . htmlspecialchars($row['name']) . '" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                                <p class="text-muted mb-1">Renter: <a href="profile_client.php?clientname=' . htmlspecialchars($row['client_name']) . '"> <strong>' . htmlspecialchars($row['client_name']) . '</strong></a> </p>
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
</main>

<?php require_once("includes/footerUsers.php"); ?>