<?php
include("../../Module/DB_conn.php");

$output = '';

$output .= " <div>
  <table style = 'border:1'class='table table-hover'>
  <thead>
  <tr>
        <th id='th'>Cake Flavor Types</th>
        <th id='th'>Total Cost Per Pound</th>
        <th id='th'>Selling price Per Pound</th>
        <th id='th'>Profit</th>
        <th id='th'>loss</th>
        
     </tr>
  </thead>";

$sql = "SELECT * FROM (inventory_cost INNER JOIN cake_flavor_info ON inventory_cost.cake_id = cake_flavor_info.cake_id)";

$execute = mysqli_query($conn, $sql);
if ($execute) {

   while ($row = mysqli_fetch_assoc($execute)) {
      $id = $row['cost_id'];
      $id = (string)$id;
      $ciphering = "AES-128-CTR";
      $encription_key = "1413348874";
      $option = 0;
      $encription_iv = "1988406007151846";

      $encript_id = openssl_encrypt($id, $ciphering, $encription_key, $option, $encription_iv);
     $discount_p = $row['discount'];

     $discount_p = substr($discount_p,0,-1);
     $discount_int = (int)$discount_p;

     $total_price = $row['total_price'];
     $discount = ($total_price*$discount_int)/100;
     $selling_price = $total_price - $discount;
     $total_cost = $row['total_cost'];


     $profit=$loss=$profit_p=$loss_p=0;

     if($selling_price>$total_cost){
      $profit = $selling_price-$total_cost;
      $profit_p =($profit*100)/$total_cost;
      $profit_p = round($profit_p,2);
     }else{
        $loss = $total_cost -$selling_price;
        $loss_p =($profit*100)/$total_cost;
        $loss_p = round($profit_p,2);
     }

     

      
      $output .= "<tbody>
                  <tr>

                  <td align='center' id='td'  class='" . $encript_id . "'>" . $row['cake_flavor_types'] . "</td>

                  <td id='td'  align='center' class='" . $encript_id . "'>" . $row['total_cost'] . "  </td>

                  <td id='td' align='center'  class='" . $encript_id . "'><del>" . $row['total_price']. "</del> <b>{$selling_price}</b></td>

                  <td id='td' align='center'  class='" . $encript_id . "'>{$profit_p}% = {$profit} </td>

                  <td id='td' align='center' class='" . $encript_id . "'>{$loss_p}% = {$loss} </td>
                  </tr>
                  </tbody>
            ";
      // <!-- 
     // <td class='" . $encript_id . "'>" . $row['material_cost'] . "</td>
                  // <td class='" . $encript_id . "'>" . $row['transportation_cost'] . "</td>
                  // <td class='" . $encript_id . "'>" . $row['utility_cost'] . "</td>
                  // <td class='" . $encript_id . "'>" . $row['space_cost'] . "</td>
                  // <td class='" . $encript_id . "'>" . $row['staff_cost'] . "</td> 
      // echo "<tr>"; 
      //   echo "<td> ".$row['cat_name']." </td>";
      //   echo "<td> ".$row['cat_code']." </td>";
      //   echo '<td class="btn btn-success"> <a href= "  ./php_controler/edit.php?id='.$row['id'].'">Edit</a></td>';

      //   echo "</tr>";-->

   }
   $output .= "</table></div>";

   echo $output;
} else {
   echo "Data base execute err";
}
?>