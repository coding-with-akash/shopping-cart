<?php

//  require_once __DIR__ . '/vendor/autoload.php';
// $con= new MongoDB\Client("mongodb://localhost:27017");
// // print_r($con);

function login(){
 if(isset($_POST['submit']))
 {
   $name = ($_POST['name']);
  $pass = ($_POST['pass']);
    if(empty($name) || empty($pass))
    {
     echo "Empty or invalid email address";
    }
    if(empty($pass)||empty($name)){
     echo "Enter your password"; 
      }
      $server="127.0.0.1:3307";
      $username="root";
      $password="";
      $db="Productdb";
      $con=new mysqli($server,$username,$password,$db);
     if($con)
      {
        // $sql="SELECT * FROM `logintb` WHERE 'name'='$name' AND 'password'='$pass' ";
        // $sql = "SELECT * FROM `logintb`";
        $sql = "SELECT name,password FROM `logintb` ";
        $result=mysqli_query($con,$sql);
    if($result){
        
        echo '<script>alert("Welcome to MyCart")</script>';
        header("Location:new/index.php");
  
          }
       }
    else
     {
      echo '<script>alert("enter correct information")</script>';
        // header("Location:./form.php");
      require_once("./form.php");
     }

      } else { 
      die("database not connected");
      } 
        };
    



function registration(){
    $server="127.0.0.1:3307";
    $username="root";
    $password="";
    $db="Productdb";
    $con=new mysqli($server,$username,$password,$db);

$name=$_POST["name2"];
$pass=$_POST["pass2"];

$sql="INSERT INTO `logintb` ( `name`, `password`) VALUES ('$name','$pass')";
$result=mysqli_query($con,$sql);
if($result){
    // echo"registerd";
     header("Location:./form.php");
}
else{
   echo "fail";
}


};



if(isset($_POST['submit'])){
    login();
}
if(isset($_POST['registration'])){
    registration();
}


?>
 
 