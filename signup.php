<?php
$title = "Sign Up";
require_once("includes/header.php");

session_start();
include "db_conn.php";

$error = [];
$success = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"] ?? '';
    $username = $_POST["user_name"] ?? '';
    $password = $_POST["password"] ?? '';
    $email = $_POST["email"] ?? '';
    $phonenum = $_POST["phonenum"] ?? '';
    $address = $_POST["address"] ?? '';
    $confirmpassword = $_POST["confirmpassword"] ?? '';
    $role = $_POST["role"] ?? '';

    if (empty($error)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error[] = "Username or email is already taken.";
        } else {
            if ($password === $confirmpassword) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                
                if ($role == 'client') {
                    $stmt = $conn->prepare("INSERT INTO clients (full_name, client_name, phone_num, email, address, password, status, date) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                } else {
                    $stmt = $conn->prepare("INSERT INTO users (full_name, user_name, phone_num, email, address, password, status, date) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                }

                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date = date("Y-m-d H:i:s");

                $status = "Pending";

                $stmt->bind_param("ssssssss", $name, $username, $phonenum, $email, $address, $hashedPassword, $status, $date);

                if ($stmt->execute()) {
                    $success[] = "Account has been created successfully. Please login";

                } else {
                    $error[] = "There was an error while processing your request.";
                }
            } else {
                $error[] = "Passwords do not match.";
            }
        }
    }
}
?>

<main>
    <div class="container-fluid gap">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <i class="bi bi-person-fill" style="display: inline-block; width: 100px; font-size: 100px;"></i>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4>User Sign Up</h4>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <?php if (!empty($success)) {
                            foreach ($success as $msg) { ?>
                                <p class="alert alert-success"><?php echo $msg; ?></p>
                            <?php }
                        } ?>
                        <?php if (!empty($error)) {
                            foreach ($error as $err) { ?>
                                <p class="alert alert-danger"><?php echo $err; ?></p>
                            <?php }
                        } ?>

                        <form action="" method="post">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input class="form-control" name="email" placeholder="Email" type="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No*</label>
                                            <input class="form-control" name="phonenum" placeholder="Contact No" type="number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Full Address</label>
                                        <div class="form-group">
                                            <textarea class="form-control" id="address" name="address" placeholder="Full Address" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <span class="badge badge-pill badge-info">Login Credentials</span>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Username*</label>
                                        <div class="form-group">
                                            <input class="form-control" id="user_name" name="user_name" placeholder="Username" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password*</label>
                                        <div class="form-group">
                                            <input class="form-control" id="password" name="password" placeholder="Password" type="password" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Confirm Password</label>
                                        <div class="form-group">
                                            <input class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" type="password" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sign Up As</label>
                                            <select class="form-control" name="role" required>
                                                <option value="user">User</option>
                                                <option value="client">Client</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8 mx-auto">
                                        <center>
                                            <br>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block btn-lg form-control" id="Button1" name="submit" type="submit">Sign Up</button>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="index.php"> << Back to Home</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once("includes/footer.php");
?>
