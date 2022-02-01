 <?php

   //^  Database Connect
   include("../../Module/DB_conn.php");
   ?>

 <?php

   $success = $err = '';

   function check($input_value)
   {
      $data = htmlspecialchars($input_value);
      $data = stripslashes($input_value);
      $data = trim($input_value);
      return $data;
   }


   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = check($_POST["name"]); //cake flavor types name
      $total_price = check($_POST["price"]);
      $discount_p = check($_POST["discount"]);


      //for below codes,one can't insert one value twice.in word cake flavor types remain unique
      $sql1 = "SELECT * FROM cake_flavor_info WHERE cake_flavor_types='$name'";
      $execute1 = mysqli_query($conn, $sql1);
      if ($execute1->num_rows > 0) {
         echo (1);
      } else {

         //insert data into cake flavor info table
         $sql = "INSERT INTO cake_flavor_info (cake_flavor_types,total_price,discount) VALUES(?,?,?)";

         $statment = mysqli_prepare($conn, $sql);
         if ($statment) {
            mysqli_stmt_bind_param($statment, "sss", $name, $total_price, $discount_p);
            $name = $name;
            $total_price = $total_price; //Total price means a number of money that is the price of a pound of cake. in a word, price of a pound of cake ;
            $discount_p = $discount_p;
            $execute = mysqli_stmt_execute($statment);
            if ($execute) {
               echo (2);
            } else {
               $err = "no";
            }
         }
      }
   }




   ?>