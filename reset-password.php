<?php
require('includes/header.php');
require("db_conn.php");

$token = $_GET["token"] ?? '';
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    echo "<script>
    alert('Your reset password token cannot be found. Check your email.');
    window.location.href = 'index.php';
    </script>";
    exit();
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    echo "<script>
    alert('Your reset password token has expired.');
    window.location.href = 'index.php';
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    var_dump($_POST);
    $password = $_POST["password"] ?? '';
    $confirmpassword = $_POST["confirmpassword"] ?? '';

    if ($password === $confirmpassword) {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $hashedPassword, $user['id']);
        $stmt->execute();

        
        if ($stmt->affected_rows > 0) {
            header("Location: login.php");
            exit();
        } else {
            header("Location: signup.php");
            exit();
        }
    } else {
        
        header("Location: reset_password.php?token=$token"); 
        exit();
    }
}

$email = $user['email'];
$sql_clients = "SELECT * FROM clients WHERE email = ?";
$stmt_clients = $conn->prepare($sql_clients);
$stmt_clients->bind_param("s", $email);
$stmt_clients->execute();
$result_clients = $stmt_clients->get_result();
$client = $result_clients->fetch_assoc();

if ($client) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account_type'])) {
        $account_type = $_POST['account_type'];

        if ($account_type === 'user') {
            header("Location: reset_password_user.php?token=$token");
            exit();
        } elseif ($account_type === 'client') {
            header("Location: reset_password_client.php?token=$token");
            exit();
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
                        <h3 class="text-center">Select Account to Reset Password</h3>
                        <hr>
                        <form action="" method="post">
                            <div class="form-group">
                                <p>It seems you have accounts in both users and clients:</p>
                                <label class="mt-3 fw-bold">Select Account Type:</label>
                                <select name="account_type" class="form-control mt-2" required>
                                    <option value="user">User Account</option>
                                    <option value="client">Client Account</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    require_once("includes/footer.php");
    exit();
}
?>

<main class="darkbody">
    <div class="container gap mb-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Reset Password</h3>
                        <hr>
                        <form action="" method="post">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once("includes/footer.php");
?>
