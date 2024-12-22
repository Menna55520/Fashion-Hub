<?php 
require_once "dbConnection.php" ;
require_once "session.php" ;

if(isset($_POST['Addtocart'])){
    $id = $_GET['id'] ;
    $q = "select id from products where id=$id" ;
    $r = mysqli_query($conn , $q) ;
    if(mysqli_num_rows($r) == 0){
       header("location:404.php");
    }else{
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $query = "select * from products where id=$id" ;
        $run = mysqli_query($conn , $query) ;
        if(mysqli_num_rows($run) > 0){
            $product = mysqli_fetch_assoc($run) ;
        }
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['quantity']++;
            $_SESSION['cart'][$id]['subtotal'] += $product['price']  ;
        }else{
           
                $_SESSION['cart'][$id] = [
                    'image' => $product['image'] ,
                    'price' => $product['price'] ,
                    'quantity' => 1 ,
                    'name' => $product['name'] ,
                    'desc' => $product['description'] ,
                    'subtotal' => $product['price'] 
                ];
            }
        }
        header("location:shop.php");
    }
else{
    header("location:shop.php");
}



?>