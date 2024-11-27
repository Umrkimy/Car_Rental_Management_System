<?php
$title = "Update Car";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    $sql = "SELECT * FROM cars WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];
        $seats = $row['seats'];
        $trans = $row['trans'];
        $image = $row['image'];
        
    } else {
        echo '<div class="alert alert-danger text-center">Car not found.</div>';
        exit();
    }

    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $seats = $_POST['seats'];
        $trans = $_POST['trans'];

        $imagefilename = $_FILES['file']['name'];
        $imagefileerror = $_FILES['file']['error'];
        $imagefiletemp = $_FILES['file']['tmp_name'];
        $filename_separate = explode('.', $imagefilename);
        $filename_extension = strtolower(end($filename_separate));

        $allowed_extensions = array('jpeg', 'jpg', 'png');

        if ($imagefilename && in_array($filename_extension, $allowed_extensions)) {
            $upload_image = 'imgs/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);
        } else {
            $upload_image = $image; 
        }

        $price_with_RM = 'RM ' . $price;

        $sql = "UPDATE cars SET 
                name='$name', 
                price='$price_with_RM', 
                seats='$seats', 
                trans='$trans', 
                image='$upload_image' 
                WHERE id='$id'";

        $result = mysqli_query($conn, $sql);

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
                            <input type="text" id="name" name="name" class="form-control" value="<?= $name ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price">Price (Daily)</label>
                            <input type="number" id="price" name="price" class="form-control" value="<?= str_replace('RM ', '', $price) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="seats">Seats</label>
                            <input type="number" id="seats" name="seats" class="form-control" value="<?= $seats ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="trans">Transmission</label>
                            <select class="form-control" name="trans" required>
                                <option value="Manual" <?= $trans == "Manual" ? "selected" : "" ?>>Manual</option>
                                <option value="Automatic" <?= $trans == "Automatic" ? "selected" : "" ?>>Automatic</option>
                            </select>
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
                    <img src="<?= $image ?>" alt="Car Image" class="img-fluid mt-3">
                </div>
            </div>
        </div>
    </div>
</main>