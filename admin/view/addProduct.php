<?php

include "../view/header.php";

include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";
?>

<?php
if(isset($_POST['addProduct'])){
  // extract
  htmlspecialchars(trim(extract($_POST))) ;
  $image = $_FILES['image'] ;
  $imageName = $image['name'];
  $imageTmp = $image['tmp_name'];
  $ext = pathinfo($imageName , PATHINFO_EXTENSION);
  
  // validation
  $error = 0 ;
  if(empty($category)){
      echo"<script>alert('Category Is required')</script>" ;
      $error = 1 ;
  }else{
    // check if category is already exist 
    $q = "select name from categories where name='$category'" ;
    $r = mysqli_query($conn , $q);
    if(mysqli_num_rows($r) == 0){
      echo"<script>alert('Category Not Found')</script>" ;
      $error = 1 ;

    }
  }
  if(empty($title)){
      echo"<script>alert('title Is required')</script>" ;
      $error = 1 ;

  }
  if(empty($desc)){
      echo"<script>alert('description Is required')</script>" ;
      $error = 1 ;

  }
  if(empty($price)){
      echo"<script>alert('price Is required')</script>" ;
      $error = 1 ;

  }
  if(empty($quantity)){
      echo"<script>alert('Quantity Is required')</script>" ;
      $error = 1 ;

  }
  if(empty($imageName)){
      echo"<script>alert('Image Is required')</script>" ;
      $error = 1 ;

  }else{
    $imageNewName = uniqid().".$ext" ;
  }
  if($error == 0){
    $query = "select name from products where name='$title'" ;
    $run = mysqli_query($conn , $query);
    if(mysqli_num_rows($run) == 1){
        echo "<script>alert('Product already Exists')</script>" ;
    }else{
      // not found so add it
      $q = "insert into products (`category_name`,`name`,`image`,`description`,`price`,`quantity`)values('$category','$title','$imageNewName','$desc','$price','$quantity')";
      $run = mysqli_query($conn , $q);
      if($run){
          echo "<script>alert('Product Added Successfully')</script>" ;
          move_uploaded_file($imageTmp , "../upload/$imageNewName");
      }else{
        echo "<script>alert('Error While Adding')</script>" ;
      }
    }
  }
    

  
  
}

?>

      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">


              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control p_input" value="<?php if(isset($_POST['category'])) echo $_POST['category']?>" >
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input"  value="<?php if(isset($_POST['title'])) echo $_POST['title']?>">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="desc" class="form-control p_input"  value="<?php if(isset($_POST['desc'])) echo $_POST['desc']?>">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control p_input"  value="<?php if(isset($_POST['price'])) echo $_POST['price']?>">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control p_input"  value="<?php if(isset($_POST['quantity'])) echo $_POST['quantity']?>">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
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