<?php
$title = "Manage";
require_once("includes/headerClients.php");
include "../db_conn.php";

$message = "";

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $seats = mysqli_real_escape_string($conn, $_POST['seats']);
    $trans = mysqli_real_escape_string($conn, $_POST['trans']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $image = $_FILES['file'];

    $imagefilename = $image['name'];
    $imagefileerror = $image['error'];
    $imagefiletemp = $image['tmp_name'];
    $filename_separate = explode('.', $imagefilename);
    $filename_extension = strtolower(end($filename_separate));

    $allowed_extensions = array('jpeg', 'jpg', 'png');

    if (in_array($filename_extension, $allowed_extensions)) {
        if (!is_dir('../imgs/cars/')) {
            mkdir('../imgs/cars/', 0777, true);
        }

        $unique_filename = uniqid('car_', true) . '.' . $filename_extension;
        $upload_image = '../imgs/cars/' . $unique_filename;

        if (move_uploaded_file($imagefiletemp, $upload_image)) {
            $price_with_RM = 'RM ' . number_format($price, 2);

            $sql = "INSERT INTO cars (name, price, seats, trans, client_name, image, state, city) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssisssss", $name, $price_with_RM, $seats, $trans, $clientnametop, $upload_image, $state, $city);

            if (mysqli_stmt_execute($stmt)) {
                $message = '<div class="alert alert-success text-center">Data inserted successfully.</div>';
            } else {
                $message = '<div class="alert alert-danger text-center">Failed to insert data into the database.</div>';
            }
        } else {
            $message = '<div class="alert alert-danger text-center">Failed to upload the image.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger text-center">Invalid file type. Only JPG, JPEG, and PNG are allowed.</div>';
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
                                    <a href="manage.php" class="text-decoration-none home-link">Cars Manage
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                    <a class="text-decoration-none text-light">Add Cars
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Add Cars</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="container d-flex justify-content-center align-items-center mt-5 mb-5" >
    <div class="card" style="width: 80rem;">
        <div class="card-header text-center">
            <h1>Add Cars</h1>
        </div>
        <div class="card-body">
            <?= $message ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label for="name">Car Name</label>
                    <input type="text" id="name" name="name" placeholder="Car Name" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="price">Price (Daily)</label>
                    <input type="number" id="price" name="price" placeholder="Price (Daily)" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="seats">Seats</label>
                    <input type="number" id="seats" name="seats" placeholder="Number of seats" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="trans">Transmission</label>
                    <select class="form-control" name="trans" required>
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder="State" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="City" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="file">Image</label>
                    <input type="file" id="file" name="file" class="form-control" required>
                </div>
                <button class="btn btn-dark my-4 w-100" type="submit" name="save">Save</button>
            </form>
        </div>
    </div>
</div>


        </main>

<?php require_once("includes/footerClients.php"); ?>