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
      $name = check($_POST["name"]);
      $total_price = check($_POST["price"]);
      $discount_p = check($_POST["discount"]);

      // TODO: Calculation of discount TODO:
      // $discount_nu = substr($discount_p,0,1);
      // $discount_nu = (int)$discount_nu;
      // var_dump($discount_nu);

      // $x = ceil($total_price*$discount_nu);
      // $discount = ceil($x/100);
      // $selling_price = ceil($total_price-$discount);



         $sql1 = "SELECT * FROM cake_flavor_info WHERE cake_flavor_types='$name'";
         $execute1 = mysqli_query($conn, $sql1);
         if ($execute1->num_rows > 0) {
            echo (1);
         } else {

               //TODO:cake_id TODO:
            $sql = "INSERT INTO cake_flavor_info (cake_flavor_types,total_price,discount) VALUES(?,?,?)";

            $statment = mysqli_prepare($conn, $sql);
            if ($statment) {
               mysqli_stmt_bind_param($statment, "sss", $name, $total_price, $discount_p);
               $name = $name;
               $total_price = $total_price;
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