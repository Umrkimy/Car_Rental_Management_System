<?php
$title = 'Profile';
require_once("includes/headerClients.php");
include "../db_conn.php";

$message = "";
$name = $username = $email = $phonenum = $address = $ic_no = $driver_no = $bank = $status = "";

if (isset($idtop) && $idtop) {
    $stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->bind_param("i", $idtop);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        $name = $row['full_name'];
        $email = $row['email'];
        $phonenum = $row['phone_num'];
        $username = $row['client_name'];
        $ic_no = $row['ic_no'];
        $driver_no = $row['driver_no'];
        $date = $row['date'];
        $bank_no = $row['bank_no'];
        $bank = isset($row['bank_type']) ? $row['bank_type'] : '';
        $address = $row['address'];
    } else {
        $message = '<p class="alert alert-danger">User not found.</p>';
    }
    $stmt->close();
} else {
    $message = '<p class="alert alert-danger">Invalid user ID.</p>';
}

if ($status === "Unverified") {
    $message = '<p class="alert alert-warning">You need to verify your account before you can insert your cars.</p>';
}

if ($status === "Rejected") {
    $message = '<p class="alert alert-danger">Your account has been rejected from admins. please reverify your your account to be verified.</p>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["full_name"]) ? trim($_POST["full_name"]) : '';
    $username = isset($_POST["user_name"]) ? trim($_POST["user_name"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $phonenum = isset($_POST["phone_num"]) ? trim($_POST["phone_num"]) : '';
    $ic_no = isset($_POST["ic_no"]) ? trim($_POST["ic_no"]) : '';
    $driver_no = isset($_POST["driver_no"]) ? trim($_POST["driver_no"]) : '';
    $bank_no = isset($_POST["bank_no"]) ? trim($_POST["bank_no"]) : '';
    $bank = isset($_POST["bank_type"]) ? trim($_POST["bank_type"]) : '';
    $address = isset($_POST["address"]) ? trim($_POST["address"]) : '';
    $status = "Pending";

    // Image handling
    $image = isset($_FILES['file']) ? $_FILES['file'] : null;
    $upload_image = null;

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $imagefilename = $image['name'];
        $filename_separate = explode('.', $imagefilename);
        $filename_extension = strtolower(end($filename_separate));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($filename_extension, $allowed_extensions)) {
            if (!is_dir('../imgs/driver/')) {
                mkdir('../imgs/driver/', 0777, true);
            }

            $unique_filename = uniqid('driver', true) . '.' . $filename_extension;
            $upload_image = '../imgs/driver/' . $unique_filename;

            if (!move_uploaded_file($image['tmp_name'], $upload_image)) {
                $message = '<p class="alert alert-danger">Failed to upload image. Please try again.</p>';
                $upload_image = null;
            }
        } else {
            $message = '<p class="alert alert-danger">Invalid image type. Only JPG, JPEG, PNG, and GIF are allowed.</p>';
        }
    } else {
        
        $upload_image = $row['driver_img'];
    }

    
    if (empty($name) || empty($username) || empty($email) || empty($phonenum)) {
        $message = '<p class="alert alert-danger">All fields are required.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p class="alert alert-danger">Invalid email address.</p>';
    } else {
        $stmt = $conn->prepare("SELECT * FROM clients WHERE (client_name = ? OR email = ?) AND id != ?");
        $stmt->bind_param("ssi", $username, $email, $idtop);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = '<p class="alert alert-danger">Username or email is already taken.</p>';
        } else {
            $stmt = $conn->prepare("UPDATE clients SET full_name = ?, client_name = ?, email = ?, phone_num = ?, ic_no = ?, driver_no = ?, bank_no = ?, bank_type = ?, driver_img = ?, address = ?, status = ? WHERE id = ?");
            $stmt->bind_param("sssssssssssi", $name, $username, $email, $phonenum, $ic_no, $driver_no, $bank_no, $bank, $upload_image, $address, $status, $idtop);

            if ($stmt->execute()) {
                $message = '<p class="alert alert-success">Profile updated successfully.</p>';
            } else {
                $message = '<p class="alert alert-danger">Failed to update profile. Please try again.</p>';
            }
            $stmt->close();
        }
    }
}

?>

<main>

    <head>
        <link href="includes/css/profile.css" rel="stylesheet" />
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
                                    <a class="text-decoration-none text-light">Profile
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Profile</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xl px-4 mt-4 text-dark mb-5">
            <nav class="nav nav-borders">
                <a class="nav-link active ms-0" href="profile.php">Profile</a>
                <a class="nav-link" href="billing.php">Billing</a>
                <a class="nav-link" href="settings.php">Settings</a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <ul class="list-group">
                        <li class="list-group-item text-muted d-flex justify-content-between">Profile <strong><?= htmlspecialchars($username) ?></strong></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Joined</strong><span><?= htmlspecialchars(date('Y-m-d', strtotime($date))) ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Real name</strong><span><?= htmlspecialchars($name) ?></span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Status</strong><span><?= htmlspecialchars($status) ?></span></li>
                    </ul>
                </div>

                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <?= $message ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="small mb-1" for="user_name">Username</label>
                                    <input class="form-control" id="user_name" name="user_name" type="text" placeholder="Enter your username" value="<?= htmlspecialchars($username) ?>">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div>
                                        <label class="small mb-1" for="full_name">Full name <span class="text-danger">*</span></label>
                                        <input class="form-control" id="full_name" name="full_name" type="text" placeholder="Enter your full name" value="<?= htmlspecialchars($name) ?>" required>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="ic_no">IC/Passport No<span class="text-danger">*</span></label>
                                        <input class="form-control" id="ic_no" name="ic_no" type="text" placeholder="Enter your IC/Passport No" value="<?= htmlspecialchars($ic_no) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="driver_no">Driver License No<span class="text-danger">*</span></label>
                                        <input class="form-control" id="driver_no" name="driver_no" type="text" placeholder="Enter your Driver License No" value="<?= htmlspecialchars($driver_no) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 ">
                                    <label for="file">Driver License photo<span class="text-danger">*</span></label>
                                    <input type="file" id="file" name="file" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="bank_no">Bank Account No<span class="text-danger">*</span></label>
                                    <input class="form-control" id="bank_no" name="bank_no" type="text" placeholder="Enter your Bank Account No" value="<?= htmlspecialchars($bank_no) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="bank">Bank<span class="text-danger">*</span></label>
                                    <select class="form-control" id="bank" name="bank_type" required>
                                        <option value="">Select your bank</option>
                                        <option value="Maybank" <?= (isset($bank) && $bank == 'Maybank') ? 'selected' : '' ?>>Maybank</option>
                                        <option value="CIMB" <?= (isset($bank) && $bank == 'CIMB') ? 'selected' : '' ?>>CIMB</option>
                                        <option value="Bank Islam" <?= (isset($bank) && $bank == 'Bank Islam') ? 'selected' : '' ?>>Bank Islam</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required><?= htmlspecialchars($address) ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email address</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email address" value="<?= htmlspecialchars($email) ?>">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="phone_num">Phone number</label>
                                        <input class="form-control" id="phone_num" name="phone_num" type="tel" placeholder="Enter your phone number" value="<?= htmlspecialchars($phonenum) ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main>

<?php
require_once("includes/footerClients.php");
?>