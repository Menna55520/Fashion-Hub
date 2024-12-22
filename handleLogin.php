<?php 
require_once "dbConnection.php";
require_once "session.php";

if(isset($_POST['login'])){
    // extract 
    trim(htmlentities(extract($_POST)));
    //validation
    $errors = [] ;
    if(empty($email)){
        $errors[] = "Email Is Required" ;
    }
    if(empty($password)){
        $errors[] = "password Is Required" ;
    }
    // check errors 
    if(empty($errors)){
        // check if the user in database or not
        
        $query = "select is_admin , password from users where email='$email'" ;
        $runQ = mysqli_query($conn , $query);
        if(mysqli_num_rows($runQ) == 1 ){
          // check if user or admin
            $user = mysqli_fetch_assoc($runQ);
            if(password_verify($password , $user['password'])){
                if($user['is_admin']){
                    header("location:admin/view/layout.php");
                }else{
                    header("location:shop.php");
                }
            }else{
                $_SESSION['errors'] = ["NO User Found"];
                header("location:login.php");
            }
        }else{
            $_SESSION['errors'] = ["NO User Found"];
            header("location:login.php");
        }
    }else{
        $_SESSION['errors'] = $errors ;
        $_SESSION['email'] = $email ;
        $_SESSION['password'] = $password ;
        header("location:login.php");
    }
}else{
    header("location:login.php");
}



?>