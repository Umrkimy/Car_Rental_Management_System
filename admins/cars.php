<?php
$title = "Add Car";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $seats = mysqli_real_escape_string($conn, $_POST['seats']);
    $trans = mysqli_real_escape_string($conn, $_POST['trans']);
    $clientname = mysqli_real_escape_string($conn, $_POST['clientname']);
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
        if (!is_dir('../imgs/')) {
            mkdir('../imgs/', 0777, true);
        }

        $unique_filename = uniqid('car_', true) . '.' . $filename_extension;
        $upload_image = '../imgs/' . $unique_filename;

        if (move_uploaded_file($imagefiletemp, $upload_image)) {
            $price_with_RM = 'RM ' . number_format($price, 2);

            $sql = "INSERT INTO cars (name, price, seats, trans, client_name, image, state, city) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssisssss", $name, $price_with_RM, $seats, $trans, $clientname, $upload_image, $state, $city);

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

<style>
    img {
        width: 125px;
    }
</style>

<main class="mt-5 pt-3">
    <div class="card">
        <div class="card-header text-center">
            <h1>Cars Management</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $message ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" required>
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
                            <label for="name">Client Name</label>
                            <input type="text" id="name" name="clientname" placeholder="Client Name" class="form-control" required>
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

                <div class="col-md-6">
                    <h2 class="text-center mb-4">Cars</h2>
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
                            $sql = "SELECT * FROM cars";
                            $result = mysqli_query($conn, $sql);
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
                                    <td><img src="' . $image . '" alt="Car Image" style="width: 100px;"/></td>
                                    <td>' . $name . '</td>
                                    <td>' . $price . '</td>
                                    <td>' . $seats . '</td>
                                    <td>' . $trans . '</td>
                                    <td>' . $clientname . '</td>
                                    <td>' . $state . '</td>
                                    <td>' . $city . '</td>
                                    <td>
                                        <a href="cars-update.php?updateid=' . $id . '" class="btn btn-primary btn-sm">Update</a>
                                        <a href="cars-delete.php?deleteid=' . $id . '" class="btn btn-danger btn-sm">Delete</a>
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