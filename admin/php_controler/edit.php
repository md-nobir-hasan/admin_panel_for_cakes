<?php
include("../../Module/DB_conn.php");


    function check($value){
        $data = trim($value);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if(isset($_POST['num_product'])){
    $num_product = check($_POST['num_product']);
    $cake_id = check($_POST['cake_id']);

    // echo $cake_id;


    $sql = "SELECT * FROM cake_flavor_info WHERE cake_id = $cake_id";

    $execute = mysqli_query($conn, $sql);
    if ($execute) {

      $row = mysqli_fetch_assoc($execute);
      $total_price = $row['total_price'];
      $discount_p = $row['discount'];

      $discount_p = substr($discount_p,0,-1);
      $discount_n=(int)$discount_p;
      $discount = $discount_n*$total_price;
      $discount = $discount/100;


      $selling_price = $total_price - $discount;
      $sell_with_dis = $selling_price * $num_product;

    // echo $num_product;
    $sql = "UPDATE cake_flavor_info SET sold_out_dis=$num_product,sell_with_dis=$sell_with_dis WHERE cake_id=$cake_id";
    $execute = mysqli_query($conn,$sql);

    if($execute){
        $msg_successful = "Successfully uploded";
        echo $msg_successful;
    }else{
        $msg_err = "Update query fail.";
        echo $msg_err;
        }
    }else{
        $msg_err = "Select of discount query fail";
    }




}else{



    if(isset($_POST['num_p_out_dis'])){
        $num_p_out_dis = check($_POST['num_p_out_dis']);
        $cake_id = check($_POST['cake_id']);
    
        // echo $cake_id;
    
    
        $sql = "SELECT * FROM cake_flavor_info WHERE cake_id = $cake_id";
    
        $execute = mysqli_query($conn, $sql);
        if ($execute) {
    
          $row = mysqli_fetch_assoc($execute);
          $total_price = $row['total_price'];
    
    
          $selling_price = $total_price;
          $sell_without_dis = $selling_price * $num_p_out_dis;
    
        // echo $num_product;
        $sql = "UPDATE cake_flavor_info SET sold_out=$num_p_out_dis,sell_without_dis=$sell_without_dis WHERE cake_id=$cake_id";
        $execute = mysqli_query($conn,$sql);
    
        if($execute){
            $msg_successful = "Successfully uploded";
            echo $msg_successful;
        }else{
            $msg_err = "Update query fail.";
            echo $msg_err;
            }
        }else{
            $msg_err = "Select of discount query fail";
        }
    }
}
?>