<?php
$title = 'Forgot your password';
require_once("includes/header.php");
?>

<main>
<section>
      <div class="container gap">
         <div class="row">
            <div class="col-md-6 mx-auto">
               <br>
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <center>
                              <h3>Forgot your password</h3>
                           </center>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <hr>
                        </div>
                     </div>
                     <form action="email-password-reset.php" method="post">
                        <div class="row">
                           <div class="col">

                              <?php if (!empty($error)) {
                                 foreach ($error as $err) { ?>
                                    <p class="alert alert-danger"><?php echo $err; ?></p>
                              <?php }
                              } ?>

                              <label>Email</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo isset($username) ? $username : ''; ?>">
                              </div>
                              <br>
                              <div class="form-group">
                                 <button class="btn btn-success btn-block form-control" name="Button1">Send</button>
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
   </form>
</section>
</main>