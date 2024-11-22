<?php
$title = "User Update";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$id = @$_GET['updateid'];
$message = "";
$name = $username = $email = $phonenum = $address = "";

$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['full_name'];
    $email = $row['email'];
    $phonenum = $row['phone_num'];
    $username = $row['user_name'];
    $address = $row['address'];
} else {
    $message = '<p class="alert alert-danger">User not found.</p>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phonenum = $_POST["phonenum"];
    $address = $_POST["address"];
    $confirmpassword = $_POST["confirmpassword"];

    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE (user_name = '$username' OR email = '$email') AND id != '$id'");
    if (mysqli_num_rows($duplicate) > 0) {
        $message = '<p class="alert alert-danger">Username or email is already taken.</p>';
    } else {

        if ($password == $confirmpassword) {
            $query = "UPDATE users SET 
                full_name='$name', 
                user_name='$username', 
                password='$password', 
                email='$email', 
                phone_num='$phonenum', 
                address='$address' 
                WHERE id='$id'";
            if (mysqli_query($conn, $query)) {
                $message = '<p class="alert alert-success">Updated successfully.</p>';
            } else {
                $message = '<p class="alert alert-danger">Failed to update user.</p>';
            }
        } else {
            $message = '<p class="alert alert-danger">Passwords do not match.</p>';
        }
    }
}
?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <i class="bi bi-person-fill" style="font-size: 100px;"></i>
                                <h4>Admin Update User</h4>
                                <hr>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col">
                                <?= $message ?>
                            </div>
                        </div>

                        <form action="" method="post">

                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" name="name" value="<?= htmlspecialchars($name) ?>" >
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input class="form-control" name="email" placeholder="Email" type="email" value="<?= htmlspecialchars($email) ?>"required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contant No*</label>
                                        <input class="form-control" name="phonenum" placeholder="Contact No" type="number" value="<?= htmlspecialchars($phonenum) ?>"required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Full Address</label>
                                <textarea class="form-control" name="address" rows="2"><?= htmlspecialchars($address) ?></textarea>
                            </div>

                            <div class="text-center">
                                <span class="badge badge-pill badge-info">Login Credentials</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username*</label>
                                        <input class="form-control" name="user_name" value="<?= htmlspecialchars($username) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input class="form-control" name="password" type="password" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm Password*</label>
                                        <input class="form-control" name="confirmpassword" type="password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Update User</button>
                            </div>
                        </form >

                        <br>
                        <a href="users-manage.php"><< Back to Users Management</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
