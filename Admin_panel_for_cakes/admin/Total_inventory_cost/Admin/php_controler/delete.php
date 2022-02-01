<?php

   //^  Database Connect
   include("../../Module/DB_conn.php");
   ?>
<?php
if(isset($_POST['encrition_id'])){
    $encrition_id = $_POST['encrition_id'];
    // echo $encrition_id;
    $ciphering = "AES-128-CTR";
$encription_key = "1413348874";
$option = 0;
$encrition_iv = "1988406007151846";
$id = openssl_decrypt($encrition_id, $ciphering, $encription_key, $option, $encrition_iv);
// echo $id;
$sql = "DELETE  FROM `inventory_cost` WHERE cost_id={$id}";
$exequte = mysqli_query($conn,$sql);
if($exequte){
    echo "Sucessfully deleted";
}
else{
    echo "Can't be deleted";
}

}

?>