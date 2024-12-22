<?php 
require_once "dbConnection.php" ;
require_once "session.php";

if(isset($_POST["signup"])){
    // extract data
    htmlspecialchars(trim(extract($_POST)));
    // validation
    $errors = [] ;
    if(empty($UserName)){
        $errors[] = "UserName Is required" ;
    }elseif(strlen($UserName) < 5){
        $errors[] = "UserName Must Be At Least 5 chars" ;
    }else{
        // check for unique of useName
        $query = "select id from users where userName='$UserName'" ;
        $runQuery = mysqli_query($conn , $query) ;
        if(mysqli_num_rows($runQuery) > 0){
            // found
            $errors[] = "userName Must Be Unique";
        }
    }
    if((empty($email))){
        $errors[] = "email Is required" ;
    }else{
        // check for unique of email
        $query = "select id from users where email='$email'" ;
        $runQuery = mysqli_query($conn , $query) ;
        if(mysqli_num_rows($runQuery) > 0){
            // found
            $errors[] = "Email Must Be Unique";
        }
    }
    if((empty($phone))){
        $errors[] = "phone Is required" ;
    }if((empty($password))){
        $errors[] = "password Is required" ;
    }if((empty($phone))){
        $errors[] = "phone Is required" ;
    }
    // check errors
    if(empty($errors)){
        // store in DB and go to login
        if(empty($address)) $address = null ;
        $password =password_hash($password , PASSWORD_DEFAULT);
        $query = "insert into users (`userName` ,`email`,`password`,`phone`,`address`) values('$UserName','$email','$password','$phone','$address')" ;
        $runQuery = mysqli_query($conn , $query);
        if($runQuery){
            $_SESSION['success'] = "Signed Up Successfully" ;
            header("location:login.php");
        }else{
            $_SESSION['errors'] = ["Error While Sign Up"] ;
            header("location:signup.php");
        }
    }else{
        $_SESSION['errors'] = $errors ;
        $_SESSION['UserName'] = $UserName ;
        $_SESSION['email'] = $email ;
        $_SESSION['password'] = $password ;
        $_SESSION['phone'] = $phone ;
        $_SESSION['address'] = $address ;
        header("location:signup.php");
    }
}else{
    header("location:signup.php");
}




?>