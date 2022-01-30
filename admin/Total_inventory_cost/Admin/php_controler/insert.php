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
      $cake_name = check($_POST["cake_name"]);
      $rm = check($_POST["material_c"]); //raw material cost
      $t = check($_POST["trta_c"]);  //transportation cost
      $u_p = check($_POST["ul_c"]);  //utility cost
      $s = check($_POST["sp_c"]);  //space cost
      $st = check($_POST["st_c"]);  //staff cost
      $p = 1;                        //Number of pound.means how many pound
      //calculation of percentage
       $u = substr($u_p,0,-1);
      $u = (int)$u;
      // Sub-category table transection
      $sql1 = "SELECT cake_flavor_info.cake_flavor_types FROM ( inventory_cost INNER JOIN cake_flavor_info on cake_flavor_info.cake_id = inventory_cost.cost_id) WHERE cake_flavor_info.cake_flavor_types = '$cake_name'";
      $execute = mysqli_query($conn, $sql1);
      if ($execute->num_rows>0) {
         echo(3);
      } 
      else {
         $sql = "SELECT cake_id FROM cake_flavor_info WHERE cake_flavor_types='$cake_name'";

         $execute = mysqli_query($conn,$sql);
         if($execute->num_rows>0){

            $rows = mysqli_fetch_assoc($execute);
            if($rows){
               $cake_id = $rows['cake_id'];
               $m = $rm*$p;
               $u = 450+($m*3);
               $u = $u/100;
               $tas = $t+$s;
               $total_cost = $m + $u + $st + $tas;
   
               $sql = "INSERT INTO inventory_cost (cake_id,material_cost,transportation_cost,utility_cost,space_cost,staff_cost,total_cost) VALUES(?,?,?,?,?,?,?)";
   
               $statment = mysqli_prepare($conn, $sql);
               if ($statment) {
                  
                  mysqli_stmt_bind_param($statment, "iiisiii", $cake_id,$m,$t,$u,$s,$st,$total_cost);

                  $cake_id = $cake_id;
                  $m = $m;
                  $t = $t;
                  $u = $u_p."=".$u;
                  $s = $s;
                  $st = $st;
                  $total_cost = $total_cost;
                  $execute = mysqli_stmt_execute($statment);
                  if ($execute) {
                     echo (1);
                  }
                  else {
                     echo "Don't inserted";
                  }
               }

            }
           
         }
         
      }
   }





   ?>