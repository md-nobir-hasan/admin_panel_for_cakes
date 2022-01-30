<?php
        include("../../Module/DB_conn.php");
        ?>
     <?php
        // $cat_name = $cat_code = "";
        //  if($_SERVER["REQUEST_METHOD"]=="POST"){
        $cost_id = $_POST['cost_id'];
        // $name = $_POST['name'];
        // $code = $_POST['code'];

        $success = $err = $exist = '';
            // echo $cost_id;

        function check($input_value)
        {
            $data = htmlspecialchars($input_value);
            $data = stripslashes($input_value);
            $data = trim($input_value);
            return $data;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cake_name = check($_POST["cake_name_m"]);
            $rm = check($_POST["material_cost"]);  //raw material cost
            $t = check($_POST["transportation_cost"]);  //transportation cost
            $u_p = check($_POST["utility_cost"]);   //utility cost
            $s = check($_POST["space_cost"]);  //space cost

            $st = check($_POST["staff_cost"]);  //staff cost
            $p = 1;   //Number of pound.means how many pound
            $u = substr($u_p,0,-1);
            $u = (int)$u;

            $sql = "SELECT cake_id FROM cake_flavor_info WHERE cake_flavor_types='$cake_name'";
            $execute = mysqli_query($conn,$sql);
            if($execute->num_rows>0){
   
               $rows = mysqli_fetch_assoc($execute);
               if($rows){
                  $cake_id = $rows['cake_id'];
                  $m = $rm*$p;
                  $st = $st*$p;
                  $u = 450+($m*3);
                  $u = $u/100;
                  $tas = $t+$s;
                  $total_cost = $m + $u + $st + $tas;

                  $db_u_up = $u_p.'='.$u;

                  $sql = "UPDATE `inventory_cost` SET `cake_id`={$cake_id},`material_cost`= {$m},`transportation_cost`={$t},`utility_cost`= '{$db_u_up}',`space_cost`={$s},`staff_cost`={$st},`total_cost`= {$total_cost} WHERE cost_id={$cost_id}";
                  $execute = mysqli_query($conn, $sql);

                  if ($execute) {
                    $success = "Sucessfully Updaded";
                    echo $success;
                    // header("location: ../sub_category.php");
                } else {
                    $err = "Opps err";
                    echo $err;
                }

                 }
                }
                else{
                    echo "Please select cake flavor type";
                }

               
               
            // }
        }
        else{
            echo "post method not found";
        }








        ?>