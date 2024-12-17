<?php
$title = "Login";
require_once("includes/header.php");
require __DIR__ . "/vendor/autoload.php";

require_once "config.php";
include "db_conn.php";

$error = [];

$google = new Google\Client();

$google->setClientId("51478706271-r5sh6jitmar1as19l4j6v5m8rlb8pvge.apps.googleusercontent.com");
$google->setClientSecret("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");
$google->setRedirectUri("http://localhost/fyp/google.php");

$google->addScope("email");
$google->addScope("profile");

$url = $google->createAuthUrl();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email'] ?? '');
    $password = validate($_POST['password'] ?? '');

    if (empty($email)) {
        $error[] = 'Email is required';
    } elseif (empty($password)) {
        $error[] = 'Password is required';
    }

    if (empty($error)) {

        $sql = "
    SELECT 'users' AS user_type, id, email, user_name AS username, password 
    FROM users 
    WHERE email = ? 
    UNION
    SELECT 'clients' AS user_type, id, email, client_name AS username, password 
    FROM clients 
    WHERE email = ? 
    UNION
    SELECT 'admins' AS user_type, id, email, admin_name AS username, password 
    FROM admins 
    WHERE email = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) > 1) {
            $row = $result->fetch_assoc();
            if ($row['user_type'] == 'users') {
                header("Location: duplicate-acc.php?email=" . urlencode($email));
            } elseif ($row['user_type'] == 'clients') {
                header("Location: duplicate-acc.php?email=" . urlencode($email));
            }
            exit();
        } elseif ($result && mysqli_num_rows($result) === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['status'] = $row['status'];

                if ($row['user_type'] == 'users') {
                    header("Location: users");
                } elseif ($row['user_type'] == 'clients') {
                    header("Location: clients");
                } else {
                    header("Location: admins");
                }
                exit();
            } else {
                $error[] = 'Incorrect password';
            }
        } else {
            $error[] = 'Incorrect username or password';
        }
    }
}
?>

<main class="darkbody">
    <div class="container gap mb-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <br>
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
                                    <h3>Login</h3>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <?php if (!empty($error)) {
                            foreach ($error as $err) { ?>
                                <p class="alert alert-danger"><?php echo $err; ?></p>
                        <?php }
                        } ?>

                        <form action="" method="post">

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                                    <form>
                                        <div class="text-center mb-3">
                                            <p>Sign in with:</p>

                                            <a href="<?php echo $url; ?>" class="btn btn-link btn-floating mx-1">
                                                <i class="bi bi-google text-dark"></i>
                                            </a>

                                        </div>

                                        <p class="text-center">or:</p>

                                        <div class="row">
                                            <div class="col">
                                                
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                                                </div>
                                            
                                                <div class="form-group mt-3">
                                                    <input type="password" class="form-control" name="password" type="password" placeholder="Password" required>
                                                </div>

                                                <div class="form-group mt-3 mb-3 d-flex justify-content-center align-items-center">
                                                    <a class="text-dark d-flex align-items-center" href="forgot-password.php">
                                                        Forgot password?
                                                    </a>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary btn-block form-control text-uppercase" name="Button1">Log in</button>
                                                </div>


                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>
                            <div class="mt-2">
                                <a class="text-dark text-decoration-none" href="index.php">&lt;&lt; Back to Home</a>
                            </div>
                    </div>
                </div>
            </div>
</main>

<?php require_once("includes/footer.php"); ?>