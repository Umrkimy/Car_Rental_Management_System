<?php
$title = "Add User";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["user_name"]);
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $email = trim($_POST["email"]);
    $phonenum = trim($_POST["phonenum"]);
    $address = trim($_POST["address"]);
    $status = "Pending";
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = date("Y-m-d H:i:s");

    if (empty($username) || empty($password) || empty($email) || empty($phonenum)) {
        $message = '<p class="alert alert-danger">Please fill in all required fields.</p>';
    } elseif ($password !== $confirmpassword) {
        $message = '<p class="alert alert-danger">Passwords do not match.</p>';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = '<p class="alert alert-danger">Username or email is already taken.</p>';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (full_name, user_name, phone_num, email, address, password, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $username, $phonenum, $email, $address, $hashedPassword, $status, $date);

            if ($stmt->execute()) {
                $message = '<p class="alert alert-success">User added successfully.</p>';
            } else {
                $message = '<p class="alert alert-danger">Failed to add user. Please try again.</p>';
            }
            $stmt->close();
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
                                <h4>Admin Add User</h4>
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
                                <input class="form-control" name="name" placeholder="Full Name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input class="form-control" name="email" placeholder="Email" type="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No*</label>
                                        <input class="form-control" name="phonenum" placeholder="Contact No" type="number" value="<?= htmlspecialchars($_POST['phonenum'] ?? '') ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Full Address</label>
                                <textarea class="form-control" name="address" placeholder="Full Address" rows="2"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
                            </div>

                            <div class="text-center">
                                <span class="badge badge-pill badge-info">Login Credentials</span>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username*</label>
                                        <input class="form-control" name="user_name" placeholder="Username" value="<?= htmlspecialchars($_POST['user_name'] ?? '') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input class="form-control" name="password" placeholder="Password" type="password" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm Password*</label>
                                        <input class="form-control" name="confirmpassword" placeholder="Confirm Password" type="password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Add User</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <a href="users-manage.php">&laquo; Back to Users Management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
