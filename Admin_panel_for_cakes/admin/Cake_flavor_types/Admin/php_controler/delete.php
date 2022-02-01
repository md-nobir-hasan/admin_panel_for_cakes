<?php

//^  Database Connect
include("../../Module/DB_conn.php");
?>
<?php
if (isset($_POST['encrition_id'])) {
    $encrition_id = $_POST['encrition_id']; //encription id = cake id
    $ciphering = "AES-128-CTR";
    $encription_key = "1413348874";
    $option = 0;
    $encrition_iv = "1988406007151846";
    //id = cake id
    $id = openssl_decrypt($encrition_id, $ciphering, $encription_key, $option, $encrition_iv);

    //this query is for cake flavor info delet by id
    $sql = "DELETE  FROM `inventory_cost` WHERE cake_id={$id}";
    $exequte = mysqli_query($conn, $sql);
    if ($exequte) {
        $sql = "DELETE FROM `cake_flavor_info` WHERE cake_id={$id}";
        $exequte = mysqli_query($conn, $sql);
        if ($exequte) {
            echo "Sucessfully deleted";
        } else {
            echo "Cake type flavor is not deleted from the table of 'Cake Types Details'";
        }
    } else {
        echo "Cake type flavor is not deleted from the table of 'Inventoru Cost'";
    }
}

?>