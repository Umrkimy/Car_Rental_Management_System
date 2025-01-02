<?php
$title = "Manage";
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
        $message = '<p class="alert alert-warning">You need to verify your account before you can insert your cars.</p>';
    } else if ($status === "Pending") {
        $message = '<p class="alert alert-warning">Your Account is going through verifying process. It will usually take one day.</p>';
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
                                    <a class="text-decoration-none text-light">Cars Manage
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Cars Manage</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="card-body mt-5 mb-5">

            <div class="container mt-5 mb-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <?= $message ?>
                        <div class="container mb-3 d-flex justify-content-end">
                            <?php if ($status !== "Unverified" && $status !== "Pending"): ?>
                                <a href="cars-add.php" class="btn btn-success">Add Cars</a>
                            <?php endif; ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price (Daily)</th>
                                        <th>Seats</th>
                                        <th>Transmission</th>
                                        <th>Client Name</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM cars WHERE client_name = ?";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "s", $clientnametop);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $image = $row['image'];
                                            $name = $row['name'];
                                            $price = $row['price'];
                                            $seats = $row['seats'];
                                            $trans = $row['trans'];
                                            $clientname = $row['client_name'];
                                            $state = $row['state'];
                                            $city = $row['city'];

                                            echo '<tr>
                                                <td>' . $id . '</td>
                                                <td><img src="' . $image . '" alt="Car Image" class="rounded" style="width: 100px; height: 60px; object-fit: cover;"></td>
                                                <td>' . $name . '</td>
                                                <td>' .  $price . '</td>
                                                <td>' . $seats . '</td>
                                                <td>' . ucfirst($trans) . '</td>
                                                <td>' . htmlspecialchars($clientname) . '</td>
                                                <td>' . $state . '</td>
                                                <td>' . $city . '</td>
                                                <td>
                                                    <a title="Update" href="cars-update.php?updateid=' . $id . '" class="ms-3"><i class="text-warning bi bi-pencil-fill"></i></a>
                                                    <a title="Delete" href="cars-delete.php?deleteid=' . $id . '" class="ms-3"><i class="text-danger bi bi-trash3-fill"></i></a>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</main>

<?php require_once("includes/footerClients.php"); ?>