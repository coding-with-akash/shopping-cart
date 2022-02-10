<?php
       
     
        // if(!$con){
        //     die("connection to this database failed due to". mysqli_connect_error());
        // }
        
        function addIn(){
            $server="127.0.0.1:3307";
            $username="root";
            $password="";
            $db="Productdb";
            $con=new mysqli($server,$username,$password,$db);


            $name=$_POST["name"];
            $price=$_POST["price"];
            $image=$_POST["image"];
        $sql="INSERT INTO `producttb` ( `product_name`, `product_price`, `product_image`) VALUES ('$name','$price','$image')";

         $result=mysqli_query($con,$sql);

        if($result){
            header("Location:./index.php");
        }
       else{
           echo "fail";
       }
    }
    function delIn(){
        $server="127.0.0.1:3307";
        $username="root";
        $password="";
        $db="Productdb";

        $name=$_POST["name"];
        $price=$_POST["price"];
        $image=$_POST["image"];
        $con=new mysqli($server,$username,$password,$db);
        $sql="DELETE FROM `producttb` WHERE `producttb`.`product_name` ='$name'";

        $result=mysqli_query($con,$sql);

        if($result){
            header("Location:./index.php");
        }
       else{
           echo "fail";
       }
    }

    if(isset($_POST["add"])){
        addIn();
    }
    if(isset($_POST["del"])){
        delIN();
    }
        

        
    ?>