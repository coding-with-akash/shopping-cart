<?php

//session start
session_start();
require_once ('./db.php');
require_once ('./component.php');


//create instance of class createdb
$database= new CreateDb('productdb',"producttb");

if(isset($_POST['add'])){
    // print_r($_POST['product_id']);

if(isset($_SESSION['cart'])){

 $item_array_id=array_column($_SESSION['cart'],"product_id");
//  print_r($_SESSION['cart']);
//  print_r($item_array_id);

 if(in_array($_POST['product_id'],$item_array_id)){
     echo "<script>alert('product is already added in the cart')</script>";
     echo "<script>window.location='index.php'</script>";



 }else{
     $count=count($_SESSION['cart']);
     $item_array=array(
        'product_id'=>$_POST['product_id']
    );
    $_SESSION['cart'][$count]=$item_array;
    // print_r($_SESSION);
  
 }

}else{
    $item_array=array(
        'product_id'=>$_POST['product_id']
    );

    //create new session variable
  $_SESSION['cart'][0]=$item_array;
//   print_r($_SESSION['cart']);


}


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>

<body>

<?PHP
require_once("./header.php");
?>
    <h1>welcome to shopping cart</h1>
    <div class="container">
        <div class="row text-center py-5">
          <?php
            $result=$database->getData();
            while($row=mysqli_fetch_assoc($result)){
                component($row['product_name'],$row["product_price"],$row['product_image'],$row['id']);
            }
          ?>

        </div>
        
    </div>
    <button class="open-button" onclick="openForm()">Add/Delete</button>
    <div class="form-popup" id="myForm">
    <form action="db2.php" method="post" class="form-container">
    <h1>product to add</h1>
    <input type="text" placeholder="product name" name="name" required>
    <input type="text" placeholder="Enter price" name="price" required>
    <input type="text" placeholder="Enter image url" name="image" required>
    <div class="container">
               <div class="row">
                 <div class="col-md-12 bg-light text-right">
                 <div class="fieldwrapper">
                <input type="submit" name="add" id="add" value="Add" /><input type="submit" name="del" id="del" value="Delete" />
                 </div>
                </div>
               </div>
        </div>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>








<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>