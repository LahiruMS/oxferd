<?php 

  require_once 'config.php';

  function dispaly_data(){
    global $conn;
    $query = "select * from user_form where user_type='user'";
    $result = mysqli_query($conn,$query);
    return $result;
    
  }

?>