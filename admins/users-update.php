<?php
$title = "User Update";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$id = @$_GET['updateid'];
$message = "";
$name = $username = $email = $phonenum = $address = "";

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['full_name'];
        $email = $row['email'];
        $phonenum = $row['phone_num'];
        $username = $row['user_name'];
        $address = $row['address'];
    } else {
        $message = '<p class="alert alert-danger">User not found.</p>';
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["user_name"]);
    $password = $_POST["password"];
    $email = trim($_POST["email"]);
    $phonenum = trim($_POST["phonenum"]);
    $address = trim($_POST["address"]);
    $confirmpassword = $_POST["confirmpassword"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE (user_name = ? OR email = ?) AND id != ?");
    $stmt->bind_param("ssi", $username, $email, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = '<p class="alert alert-danger">Username or email is already taken.</p>';
    } else {
        if ($password === $confirmpassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET full_name = ?, user_name = ?, password = ?, email = ?, phone_num = ?, address = ? WHERE id = ?");
            $stmt->bind_param("ssssssi", $name, $username, $hashedPassword, $email, $phonenum, $address, $id);

            if ($stmt->execute()) {
                $message = '<p class="alert alert-success">Updated successfully.</p>';
            } else {
                $message = '<p class="alert alert-danger">Failed to update user. Please try again.</p>';
            }
            $stmt->close();
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
                                        <input class="form-control" name="email" placeholder="Email" type="email" value="<?= htmlspecialchars($email) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No*</label>
                                        <input class="form-control" name="phonenum" placeholder="Contact No" type="number" value="<?= htmlspecialchars($phonenum) ?>" required>
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
                        </form>

                        <br>
                        <a href="users-manage.php">&laquo; Back to Users Management</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
