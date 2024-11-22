<?php
require('includes/header.php');
require("db_conn.php"); 

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token_hash);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result ->fetch_assoc();

        if($user === null){
            die("token not found");?>
        
        <main>

<body>
<div class="container gap mt-5">
 <div class="row">
     <div class="col-md-6 mx-auto">
         <div class="card shadow">
             <div class="card-body">
                 <div class="text-center">
                     <i class="bi bi-person-fill" style="font-size: 100px; color: #0d6efd;"></i>
                     <h3 class="mt-3">Select Account Type</h3>
                     <hr>
                 </div>

                 <p class="text-center">Choose the type of account you want to log in to:</p>
                 
                 <div class="d-flex justify-content-center gap-3 mt-4">
                     <a href="users" class="btn btn-primary btn-lg">
                         <i class="bi bi-person-badge"></i> Login as User
                     </a>
                     <a href="clients" class="btn btn-success btn-lg">
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
    <?php } ?>
    <?php

       if(strtotime($user["reset_token_expires_at"]) <= time()) {
            die("token has expired");
       } 

?>

<main>

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
                        <a href="users" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-badge"></i> Login as User
                        </a>
                        <a href="clients" class="btn btn-success btn-lg">
                            <i class="bi bi-briefcase"></i> Login as Client
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 mb-5">
                <a href="index.php" class="text-decoration-none text-dark">
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