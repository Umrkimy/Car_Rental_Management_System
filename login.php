<?php
$title = "Login";
require_once("includes/header.php");

session_start();
include "db_conn.php";

$error = [];

if (isset($_POST['username']) && isset($_POST['password'])) {

   function validate($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   $username = validate($_POST['username']);
   $password = validate($_POST['password']);

   if (empty($username)) {
      $error[] = 'Username is required';
   } elseif (empty($password)) {
      $error[] = 'Password is required';
   }

   if (empty($error)) {

      $sql = "
            SELECT 'users' AS user_type, id, user_name AS username 
            FROM users 
            WHERE user_name = '$username' AND password = '$password'
            UNION
            SELECT 'clients' AS user_type, id, user_name AS username 
            FROM clients 
            WHERE user_name = '$username' AND password = '$password'
            UNION
            SELECT 'admins' AS user_type, id, user_name AS username 
            FROM admins 
            WHERE user_name = '$username' AND password = '$password'";

      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 1) {
         $error[] = 'Duplicate login found. Please contact support.';
      } elseif ($result && mysqli_num_rows($result) === 1) {
         $row = mysqli_fetch_assoc($result);
         $_SESSION['user_name'] = $row['username'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['user_type'] = $row['user_type'];

         if ($row['user_type'] == 'users') {
            header("Location: users");
         } else if ($row['user_type'] == 'clients') {
            header("Location: clients");
         } else if ($row['user_type'] == 'admins') {
            header("Location: admins");
         }

         exit();
      } else {
         $error[] = 'Incorrect Username or Password';
      }
   }
}
?>

<main>

   <body>
      <div class="container gap">
         <div class="row">
            <div class="col-md-6 mx-auto">
               <br>
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col">
                           <center>
                              <img width="150px" src="imgs/profile.png" />
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
                     <form action="" method="post">
                        <div class="row">
                           <div class="col">

                              <?php if (!empty($error)) {
                                 foreach ($error as $err) { ?>
                                    <p class="alert alert-danger"><?php echo $err; ?></p>
                              <?php }
                              } ?>

                              <label>Username</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo isset($username) ? $username : ''; ?>">
                              </div>
                              <label>Password</label>
                              <div class="form-group">
                                 <input type="password" class="form-control" name="password" placeholder="Password">
                              </div>
                              <br>
                              <div class="form-group">
                                 <button class="btn btn-success btn-block form-control" name="Button1">Login</button>
                              </div>
                              <br>
                           </div>
                        </div>
                  </div>
               </div>
               <a href="index.php">&lt;&lt; Back to Home</a><br><br>
            </div>
         </div>
      </div>

   </body>
</main>

</html>

<?php
include("includes/footer.php");
?>