
<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";
require_once "session.php";

?>

<?php
if(isset($_SESSION['errors'])){
  foreach($_SESSION['errors'] as $error):?>
    <div class="alert alert-danger">
    <strong><?php echo  $error ?></strong>
    </div>
  <?php endforeach ;
  unset($_SESSION['errors']);
}



?>
<div class="card-body px-5 py-5" style="background-color:darkgray;">



                <h3 class="card-title text-left mb-3">Register</h3>
                <form action="handleSignUp.php" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control p_input" name="UserName" value="<?php if(isset($_SESSION['UserName'])) echo $_SESSION['UserName']?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control p_input" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control p_input" name="password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password']?>">

                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control p_input"name="phone" value="<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']?>">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control p_input" name="address" value="<?php if(isset($_SESSION['address'])) echo $_SESSION['address']?>">
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                     
                  <div class="text-center">
                    <button type="submit" name="signup" class="btn btn-primary btn-block enter-btn">Signup</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    <!-- regex 

  $regex = /^01[0,1,2,5][0-9]{8}$/

  preg_match($regex,) 
  
  -->