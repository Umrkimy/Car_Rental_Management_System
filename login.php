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
        $error[] ='Username is required';
    } else if (empty($password)) {
        $error[] ='Password is required';
    }

    if (empty($error)) {
    $sql = "SELECT * FROM users WHERE user_name = '$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['user_name'] === $username && $row['password'] === $password) {
            echo "Logged In!";
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: users");
            exit();
        } else {
            $error[] ='Incorrect Username or Password';
        }
    } else {
      $error[] ='Incorrect Username or Password';
    }
}
}
?>

<body>

   <div class="container">
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

                           <?php if (isset($error)) { foreach ($error as $err) {?>
                              <p class="alert alert-danger"> <?php echo $err; }?> </p>
                           <?php } ?>

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
                           <div class="form-group">
                              <a href="usersignup.php"><input type="button" class="btn btn-info btn-block form-control" id="Button2" value="Sign Up"></a>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
            <a href="index.php">&lt;&lt; Back to Home</a><br><br>
         </div>
      </div>
   </div>

</body>

</html>


<?php
include("includes/footer.php");
?>