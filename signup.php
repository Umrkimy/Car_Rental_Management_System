<?php
$title = "Sign Up";
require_once("includes/header.php");

session_start();
include "db_conn.php";

$error = [];

if (isset($_POST["name"], $_POST["user_name"], $_POST["password"], $_POST["email"])) {
    $name = $_POST["name"];
    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    if (empty($name) || empty($username) || empty($password) || empty($email)) {
        header("Location: userSignup.php?error=Please fill in all required fields");
        exit();
    }

    $phonenum = $_POST["phonenum"];
    $address = $_POST["address"];
    $confirmpassword = $_POST["confirmpassword"];

    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        header("Location: userSignup.php?error=Username or email is already taken");
        exit();
    } else {
        if ($password == $confirmpassword) {

            $query = "INSERT INTO users (name, user_name, phonenum, email, address, password) VALUES ('$name','$username','$phonenum','$email','$address','$password')";
            mysqli_query($conn, $query);

            header("Location: userSignup.php?success=Registration successfully");
            exit();
        } else {
            header("Location: userSignup.php?error=Password does not match");
            exit();
        }
    }
} else {
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
                                <img width="100px" src="imgs/profile.png" />
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

                    <?php if (isset($_GET['error']) || isset($_GET['success'])) : ?>
                        <div class="row">
                            <div class="col">
                                <?php if (isset($_GET['error'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_GET['error']; ?></p>
                                <?php elseif (isset($_GET['success'])) : ?>
                                    <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="userSignupQuery.php" method="post">
                        <div class="row">
                            <div class="">
                                <label>Full Name*</label>
                                <div class="form-group">
                                    <input class="form-control" id="TextBox1" name="name" placeholder="Full Name" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Contact No</label>
                                    <div class="form-group">
                                        <input class="form-control" id="phonenum" name="phonenum" placeholder="Contact No" type="number" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Email*</label>
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" />
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
                                        <input class="form-control" id="user_name" name="user_name" placeholder="Username" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Password*</label>
                                    <div class="form-group">
                                        <input class="form-control" id="password" name="password" placeholder="Password" type="password" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Confirm Password</label>
                                    <div class="form-group">
                                        <input class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" type="password" />
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
                    <a href="homepage.php">
                        << Back to Home</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
</main>