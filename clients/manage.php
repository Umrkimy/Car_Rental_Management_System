<?php
$title = "Manage";
require_once("includes/headerClients.php");
include "../db_conn.php";

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

        <div class="card mt-5 mb-5">
        <div class="card-header text-center">
            <h1>Cars Management</h1>
        </div>
        <div class="card-body">
            
        <div class=" mb-3">
                        <a href="bookings-add.php" class="btn btn-dark">Add Bookings</a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
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
                                    <td><img src="' . $image . '" alt="Car Image" style="width: 200px;"/></td>
                                    <td>' . $name . '</td>
                                    <td>' . $price . '</td>
                                    <td>' . $seats . '</td>
                                    <td>' . $trans . '</td>
                                    <td>' . $clientname . '</td>
                                    <td>' . $state . '</td>
                                    <td>' . $city . '</td>
                                    <td>
                                        <a title="Update" href="cars-update.php?updateid=' . $id . '" class="ms-2"><i class="text-warning bi bi-pencil-fill"></i></a>
                                        <a title="Delete" href="cars-delete.php?deleteid=' . $id . '" class="ms-2"><i class="bi text-danger bi-trash3-fill"></i></a>
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