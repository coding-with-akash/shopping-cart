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
      require_once __DIR__ . '/vendor/autoload.php';
      $con= new MongoDB\Client("mongodb://localhost:27017");
     if($con)
      {
        $db=$con->test2021;
      // Select Collection
        $collection=$db->table2021;
        $qry = array("name"=>"$name","pass"=>"$pass");
        $result = $collection->findOne($qry);
    if($result){
      echo '<script>alert("Welcome to MyCart")</script>';
      header("Location:new/index.php");
       }
    else
     {
      echo '<script>alert("enter correct information")</script>';
      require_once("./form.php");
     }

      } else { 
      die("Mongo DB not connected");
      } 
        }

    };
    



function registration(){

require_once __DIR__ . '/vendor/autoload.php';
$con= new MongoDB\Client("mongodb://localhost:27017");
// print_r($con);

$name=$_POST["name2"];
$pass=$_POST["pass2"];


$db=$con->test2021;
$table=$db->table2021;

$table->insertOne(["name"=>"$name","pass"=>"$pass"]);

require_once("./form.php");

};



if(isset($_POST['submit'])){
    login();
}
if(isset($_POST['registration'])){
    registration();
}


?>
 
 