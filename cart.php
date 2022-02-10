<?php


session_start();
require_once ('./db.php');
require_once ('./component.php');

$db = new CreateDb("Productdb", "Producttb");

if (isset($_POST['remove'])){
      if($_GET['action']=='remove'){
          foreach($_SESSION['cart'] as $key=>$value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
          }
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

</head>
<body class="bg-light">
<?PHP
require_once("./header.php");
?>


<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
              <div class="shopping-cart py-2">
                  <h6>My cart</h6>
                  <hr>
                 
                  <?php
                  $total=0;
                  if(isset($_SESSION['cart'])){
                    $product_id=array_column($_SESSION['cart'],'product_id');

                    $result=$db->getData();
                   while($row=mysqli_fetch_assoc($result)){
                       foreach ($product_id as $id){
                           if ($row['id']==$id){
                               cartElement($row['product_image'],$row["product_name"],$row['product_price'],$row['id']);
                               $total=$total+ (int)$row['product_price'];
                           }
                             
                       }
                    }
                  }else{
                      echo "<h5>Cart is empty</h5>";
                  }
                  
                  
                  ?>
                  
              </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>price detail</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?PHP
                        if(isset($_SESSION['cart'])){
                            $count=count($_SESSION['cart']);
                            echo"<h6>Price($count items)</h6>";
                        }
                        
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    















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