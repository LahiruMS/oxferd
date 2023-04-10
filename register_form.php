<?php

@include './config/config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $nic = mysqli_real_escape_string($conn, $_POST['nic']);
   $education = mysqli_real_escape_string($conn, $_POST['education']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $image = $_POST['image'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' && address = '$address' && nic = '$nic' && education = '$education' && image = '$image' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         
         $error[] = 'password not matched!';

      }else{
         
         $insert = "INSERT INTO user_form(name, email, password, user_type, address, nic, education, image) VALUES('$name','$email','$pass','$user_type','$address','$nic','$education','$image')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="text" name="address" required placeholder="enter your address">
      <input type="text" name="nic" required placeholder="enter your NIC number">
      <label for="formFile" class="form-label">Choose Profile Photo</label>
       <input class="form-control" type="file" id="formFile" name="image">
       <label for="inputState">Education</label>
      <select id="inputState" class="form-control" name="education">
        <option selected>After O/L</option>
        <option>After A/L</option>
        <option>Graduate</option>
      </select>
      <input type="password" name="password" required placeholder="enter your password">  
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="hidden" name="user_type" value="user">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>