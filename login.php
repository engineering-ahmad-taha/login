<?php

session_start();
$message='';
$options= array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    
);



try  
 {  
      $db = new PDO(("mysql:host=localhost; dbname=tttesting"), "root", "",$options );  
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<div> All fields are required </div>';  
        }


        else  
        {  
             $q = "SELECT * FROM users WHERE username = :username AND password = :password";  
             $statement = $db->prepare($q);  
             $statement->execute(  
                  array(  
                       'username'     =>     $_POST["username"],  
                       'password'     =>     $_POST["password"],
                  )  
             );  
             $count = $statement->rowCount();  
             if($count > 0)  
             {  
                  $_SESSION["username"] = $_POST["username"];  
                  header("location:login_success.php");  
             }  
             else  
             {  
                  $message = '<label>Wrong Data</label>';  
             }  






    }




 }


 }catch(PDOException $error)  
    {  
         $message = 'error'.$error->getMessage();  
    } 



 ?>






























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    


 
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3>PHP Login Script using PDO</h3><br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                </form>  
           </div>  





</body>
</html>




