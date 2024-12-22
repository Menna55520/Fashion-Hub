<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";
?>
<?php
if(isset($_POST['addCategory'])){
  htmlspecialchars(trim(extract($_POST))); // title
  if(empty($title)){
    echo "<script>alert('Enter The Name Of Category')</script>" ;
  }else{
        $query = "select * from categories where name='$title'" ;
        $run = mysqli_query($conn , $query);
        if(mysqli_num_rows($run) == 1){
          echo "<script>alert('Category Already Found')</script>" ;
        }else{
          $query = "insert into categories(`name`)values('$title')" ;
          $run = mysqli_query($conn , $query);
          if($run){
            echo "<script>alert('Category Added Successfully')</script>" ;
          }else{
            echo "<script>alert('Error While Adding')</script>" ;
          }
        }
  }

}


?>


              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="addCategory.php">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input text-light">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
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

<?php 
include "../view/footer.php";
 ?>