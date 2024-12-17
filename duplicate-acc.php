<?php
$title = "Login";
require_once("includes/header.php");
require_once "config.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    header("Location: index.php"); 
    exit();
}
?>

<main class="darkbody">
    <body>
        <div class="container gap mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="bi bi-person-fill" style="font-size: 100px;"></i>
                                <h3 class="mt-3">Select Account Type</h3>
                                <hr>
                            </div>

                            <p class="text-center">Choose the type of account you want to log in to:</p>
                            
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                
                                <a href="duplicate-users.php?email=<?php echo urlencode($email); ?>" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-badge"></i> Login as User
                                </a>
                                <a href="duplicate-clients.php?email=<?php echo urlencode($email); ?>" class="btn btn-success btn-lg">
                                    <i class="bi bi-briefcase"></i> Login as Client
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-5">
                        <a href="index.php" class="text-decoration-none">
                            &lt;&lt; Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main> 

<?php
require_once("includes/footer.php");
?>
