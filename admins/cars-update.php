<?php
$title = "Update Car";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    $sql = "SELECT * FROM cars WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];
        $seats = $row['seats'];
        $trans = $row['trans'];
        $clientname = $row['client_name'];
        $image = $row['image'];
        $state = $row['state'];
        $city = $row['city'];
    } else {
        echo '<div class="alert alert-danger text-center">Car not found.</div>';
        exit();
    }

    if (isset($_POST['save'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $seats = mysqli_real_escape_string($conn, $_POST['seats']);
        $trans = mysqli_real_escape_string($conn, $_POST['trans']);
        $clientname = mysqli_real_escape_string($conn, $_POST['clientname']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);

        $updated_image = $image;

        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $imagefilename = $_FILES['file']['name'];
            $imagefiletemp = $_FILES['file']['tmp_name'];
            $filename_separate = explode('.', $imagefilename);
            $filename_extension = strtolower(end($filename_separate));
            $allowed_extensions = array('jpeg', 'jpg', 'png');

            if (in_array($filename_extension, $allowed_extensions)) {
                if (!is_dir('../imgs/')) {
                    mkdir('../imgs/', 0777, true);
                }

                $unique_filename = uniqid('car_', true) . '.' . $filename_extension;
                $upload_image = '../imgs/' . $unique_filename;

                if (move_uploaded_file($imagefiletemp, $upload_image)) {
                    $updated_image = $upload_image;
                } else {
                    $message = '<div class="alert alert-danger text-center">Failed to upload the new image. Keeping the current image.</div>';
                }
            } else {
                $message = '<div class="alert alert-danger text-center">Invalid file type. Allowed: jpeg, jpg, png.</div>';
            }
        }

        $price_with_RM = 'RM ' . number_format($price, 2);

        $sql = "UPDATE cars SET 
                name=?, 
                price=?, 
                seats=?, 
                trans=?,
                client_name=?, 
                image=?, 
                state=?,
                city=?
                WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssssi", $name, $price_with_RM, $seats, $trans, $clientname, $updated_image, $state, $city, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $message = '<div class="alert alert-success text-center">Car updated successfully.</div>';
        } else {
            $message = '<div class="alert alert-danger text-center">Failed to update car. Please try again.</div>';
        }
    }
} else {
    echo '<div class="alert alert-danger text-center">No car ID specified.</div>';
    exit();
}
?>

<style>
    img {
        width: 300px;
    }
</style>

<main class="mt-5 pt-3">
    <div class="card">
        <div class="card-header text-center">
            <h1>Update Car</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $message ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price">Price (Daily)</label>
                            <input type="number" id="price" name="price" class="form-control" value="<?= htmlspecialchars(str_replace('RM ', '', $price)) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="seats">Seats</label>
                            <input type="number" id="seats" name="seats" class="form-control" value="<?= htmlspecialchars($seats) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="trans">Transmission</label>
                            <select class="form-control" name="trans" required>
                                <option value="Manual" <?= $trans == "Manual" ? "selected" : "" ?>>Manual</option>
                                <option value="Automatic" <?= $trans == "Automatic" ? "selected" : "" ?>>Automatic</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="clientname">Client Name</label>
                            <input type="text" id="clientname" name="clientname" class="form-control" value="<?= htmlspecialchars($clientname) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control" value="<?= htmlspecialchars($state) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?= htmlspecialchars($city) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="file">Image (leave blank to keep current)</label>
                            <input type="file" id="file" name="file" class="form-control">
                        </div>

                        <button class="btn btn-dark my-4 w-100" type="submit" name="save">Save</button>
                    </form>
                </div>
                <div class="col-md-6 text-center">
                    <h2>Current Car Image</h2>
                    <img src="<?= htmlspecialchars($image) ?>" alt="Car Image" class="img-fluid mt-3">
                </div>
            </div>
        </div>
    </div>
</main>
