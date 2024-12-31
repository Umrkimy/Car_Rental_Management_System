<?php
$title = 'Settings';
require_once("includes/headerUsers.php");
include "../db_conn.php";

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $currentpassword = $_POST["currentpassword"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirmpassword = $_POST["confirmpassword"] ?? '';

    if (isset($idtop) && is_numeric($idtop)) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $idtop);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($currentpassword, $row['password'])) {
                    if ($password === $currentpassword) {
                        $message = '<p class="alert alert-danger">New password cannot be the same as the current password. Please choose a different password.</p>';
                    } elseif ($password === $confirmpassword) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
                        $update_stmt = mysqli_prepare($conn, $update_sql);

                        if ($update_stmt) {
                            mysqli_stmt_bind_param($update_stmt, 'si', $hashedPassword, $idtop);
                            mysqli_stmt_execute($update_stmt);

                            if (mysqli_stmt_affected_rows($update_stmt) > 0) {
                                $message = '<p class="alert alert-success">Your password has been successfully updated.</p>';
                            } else {
                                $message = '<p class="alert alert-danger">Error updating password. Please try again.</p>';
                            }
                        } else {
                            $message = '<p class="alert alert-danger">Error preparing the update query.</p>';
                        }
                    } else {
                        $message = '<p class="alert alert-danger">New passwords do not match. Please try again.</p>';
                    }
                } else {
                    $message = '<p class="alert alert-danger">Current password is incorrect. Please try again.</p>';
                }
            } else {
                $message = '<p class="alert alert-danger">User  not found. Please try again.</p>';
            }
        } else {
            $message = '<p class="alert alert-danger">Error preparing the query.</p>';
        }
    } else {
        $message = '<p class="alert alert-danger">Invalid user ID. Please try again.</p>';
    }
}
?>

<main>

    <head>
        <link href="includes/css/settings.css" rel="stylesheet" />
    </head>

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
                                    <a class="text-decoration-none text-light">Settings
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Settings</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xl px-4 mt-4 mb-5">
            <nav class="nav nav-borders">
                <a class="nav-link ms-0" href="profile.php">Profile</a>
                <a class="nav-link " href="billing.php">Billing</a>
                <a class="nav-link active" href="settings.php">Settings</a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-lg-8">
                    <?= $message ?>

                    <div class="card mb-4">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="small mb-1" for="currentpassword">Current Password</label>
                                    <input class="form-control" name="currentpassword" id="currentpassword" type="password" placeholder="Enter current password">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">New Password</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter new password">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="confirmpassword">Confirm Password</label>
                                    <input class="form-control" name="confirmpassword" id="confirmpassword" type="password" placeholder="Confirm new password">
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">Delete Account</div>
                        <div class="card-body">
                            <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                            <a class="btn btn-danger-soft text-danger" href="settings-delete.php?deleteid=<?php echo $idtop; ?>">I understand, delete my account</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main>

<?php
require_once("includes/footerUsers.php");
?>