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

        <th id='th' class='sold_dis'>Total sold out with discount</th>
        <th id='th'  class='sold_dis'>Total sold out without discount</th>

        <th id='th'>Total profit</th>
        <th id='th'> Total loss</th>

        
     </tr>
  </thead>";

$sql = "SELECT * FROM (inventory_cost INNER JOIN cake_flavor_info ON inventory_cost.cake_id = cake_flavor_info.cake_id)";

$execute = mysqli_query($conn, $sql);
if ($execute) {

   while ($row = mysqli_fetch_assoc($execute)) {
      $cake_id = $row['cake_id'];
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
 
      $total_pr = $row['total_price'];
      $discount = ($total_pr*$discount_int)/100;
      $selling_price = $total_pr - $discount;

      //
      //calculation of profit and loss
      //

     $total_sold_price_dis = $row['sell_with_dis'];
     $total_sold_price = $row['sell_without_dis'];
    $total_sold_price = $total_sold_price +$total_sold_price_dis;


     $num_sold_out_p_dis = $row['sold_out_dis'];
      $num_sold_out_p = $row['sold_out'];
       $p = $num_sold_out_p + $num_sold_out_p_dis; //p = total number of product that sold out
       $rm = $row['material_cost'];  //raw material cost	
       $t = $row['transportation_cost'];  //transportation cost
       $u_p = $row['utility_cost'];  //utility cost
       $s = $row['space_cost'];  //space cost
       $st = $row['staff_cost'];  //staff cost 
      	
               $m = $rm*$p;
               $u = ($m*3);
               $u = $u+450;
               $u = $u/100;
               $tas = $t+$s;

         $total_cost = $m + $u + $st + $tas;
   //   $total_cost = $row['total_cost'];


     $profit=$loss=$profit_p=$loss_p=0;

     if($total_sold_price>$total_cost){
      $profit = $total_sold_price-$total_cost;
      $profit_p =($profit*100)/$total_cost;
      $profit_p = round($profit_p,2);
     }else{
        $loss = $total_cost -$total_sold_price;
        $loss_p =($loss*100)/$total_cost;
        $loss_p = round($profit_p,2);
     }

     

      
      $output .= "<tbody>
                  <tr>

                  <td align='center' id='td'  class='" . $encript_id . "'>" . $row['cake_flavor_types'] . "</td>

                  <td id='td'  align='center' class='" . $encript_id . "'>" . $row['total_cost'] . "  </td>

                  <td id='td' align='center'  class='" . $encript_id . "'><del>" . $row['total_price']. "</del> <b>{$selling_price} tk</b></td>


                  <td id='td' align='center'>
                  <button class='btn_sold' type='button' id='{$cake_id}' value='{$row['sold_out_dis']}'> p(+,-)</button>
                  <br>
                  <span id='span_sold_di> 0 </span>
                  <span id='sell_with_dis' > {$row['sold_out_dis']}p = {$row['sell_with_dis']}tk </span>
                  </td>

                  <td id='td' align='center'>
                  <button class='btn_sold_prod' type=''button' id='{$cake_id}' value='{$row['sold_out']}'> p(+,-)</button>
                  <br>
                  <span id='span_soldd> 0 </span>
                  <span id='span_sold>{$row['sold_out']}p = {$row['sell_without_dis']}tk </span>
                  </td>

                  

                  <td id='td' align='center'  class='" . $encript_id . "'>{$profit_p}% = {$profit}tk </td>

                  <td id='td' align='center' class='" . $encript_id . "'>{$loss_p}% = {$loss}tk </td>
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



<script>
   //calculation for discount
 $(document).ready(function() {
      $(".btn_sold").on("click", function() {
         var cake_id = $(this).attr('id');
         var num_sold_p = $(this).val();
         // var sell_with_dis = $('.no==').attr('id');
         // alert(cake_id);

             localStorage.setItem("num_sold_p", num_sold_p);
               var options = {
                  ajaxPrefix: ''
               };
               new Dialogify('./php_controler/body_modal.php', options)
                  .title("Edit Number of sold out product")
                  .buttons([{
                        text: "Cancle",
                        type: Dialogify.BUTTON_DANGER,
                        click: function(e) {
                           this.close();
                        }
                     },
                     {
                        text: 'Edit',
                        type: Dialogify.BUTTON_PRIMARY,
                        click: function(e) {
                           var num_product = $("#num_p").val();
                              
                           // var form_data = new FormData();
                           // form_data.append('name', $('#cake_name').val());
                           // form_data.append('total_price', $('#total_price').val());
                           // form_data.append('discount', discount_v);
                           // form_data.append('id', data[0].cake_id);
                           // alert(JSON.stringify(form_data));
                           $.ajax({
                              method: "POST",
                              url: './php_controler/edit.php',
                              data: {
                                 num_product : num_product,
                                 cake_id : cake_id
                                   },
                              // dataType:'json',
                              // contentType: false,
                              // cache: false,
                              // processData: false,
                              success: function(value) {
                                 alert(value);
                                 $.ajax({
                                    cache: false,
                                    url: "./php_controler/shows.php",
                                    method: "POST",
                                    success: function(data) {
                                       $("#show_data").html(data);
                                    }
                                 });

                              }
                           });
                        
                        }
                     }
                  ]).showModal();
      });
   });




//
//calculation without discount
//


   $(document).ready(function() {
      $(".btn_sold_prod").on("click", function() {
         var cake_id = $(this).attr('id');
         var num_sold_pro_out_dis = $(this).val();
         // var sell_with_dis = $('.no==').attr('id');
         // alert(cake_id);

             localStorage.setItem("num_sold_pro_out_dis", num_sold_pro_out_dis);
               var options = {
                  ajaxPrefix: ''
               };
               new Dialogify('./php_controler/body_modal_out_dis.php', options)
                  .title("Edit Number of sold out product")
                  .buttons([{
                        text: "Cancle",
                        type: Dialogify.BUTTON_DANGER,
                        click: function(e) {
                           this.close();
                        }
                     },
                     {
                        text: 'Edit',
                        type: Dialogify.BUTTON_PRIMARY,
                        click: function(e) {

                           var num_p_out_dis = $("#num_p_out_dis").val();
                              
                           // var form_data = new FormData();
                           // form_data.append('name', $('#cake_name').val());
                           // form_data.append('total_price', $('#total_price').val());
                           // form_data.append('discount', discount_v);
                           // form_data.append('id', data[0].cake_id);
                           // alert(JSON.stringify(form_data));
                           $.ajax({
                              method: "POST",
                              url: './php_controler/edit.php',
                              data: {
                                 num_p_out_dis : num_p_out_dis,
                                 cake_id : cake_id
                                   },
                              // dataType:'json',
                              // contentType: false,
                              // cache: false,
                              // processData: false,
                              success: function(value) {
                                 alert(value);
                                 $.ajax({
                                    cache: false,
                                    url: "./php_controler/shows.php",
                                    method: "POST",
                                    success: function(data) {
                                       $("#show_data").html(data);
                                    }
                                 });

                              }
                           });
                        
                        }
                     }
                  ]).showModal();
      });
   });
</script>

