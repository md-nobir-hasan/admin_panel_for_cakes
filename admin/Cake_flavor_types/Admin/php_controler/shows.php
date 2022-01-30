<?php
include("../../Module/DB_conn.php");

$output = '';

$output .= " <div>
  <table class='table table-hover'>
  <thead>
  <tr align='center'>
        <th>Cake Flavor Types</th>
        <th>Total Price</th>
        <th>Discount</th>
        <th align='center' colasp='2'>Action</th>
     </tr>
  </thead>";

$sql2 = "SELECT * FROM `cake_flavor_info` ORDER by cake_id  DESC";
$execute = mysqli_query($conn, $sql2);
// $row_no = $execute->num_rows;
if ($execute) {

   while ($row = mysqli_fetch_assoc($execute)) {

      $discount_p = $row['discount'];
      $total_price = $row['total_price'];
       $discount_nu = substr($discount_p,0,-1);
      $discount_nu = (int)$discount_nu;
      // var_dump($discount_nu);

      $x = ceil($total_price*$discount_nu);
      $discount = ceil($x/100);
      $selling_price = ceil($total_price-$discount);

      $id = $row['cake_id'];
      $id = (string)$id;
      $ciphering = "AES-128-CTR";
      $encription_key = "1413348874";
      $option = 0;
      $encription_iv = "1988406007151846";

      $encript_id = openssl_encrypt($id, $ciphering, $encription_key, $option, $encription_iv);

      $output .= "<tbody>
                  <tr>
                  <td value='' id='name' class='" . $encript_id . "'>" . $row['cake_flavor_types'] . "</td>

                  <td id='code' class='" . $encript_id . "'>" . $row['total_price'] . "</td>

                  <td id='details' class='" . $encript_id . "'>" . $row['discount']."=" .$discount . "</td>

                  <td><button id='{$encript_id}' type='button' class='edit btn btn-success'>Edit</button></td>

                  <td> <button id='{$encript_id}' type='button' class='Del_btn btn btn-danger' onclick='delete_data()'>Delete</button></td>
                  </tr>
                  </tbody>
            ";

   }
   $output .= "</table></div>";

   echo $output;
} else {
   echo "Data base execute err";
}

?>

<script>
   $(document).ready(function() {
      $(".edit").on("click", function() {
         var encrition_id = $(this).attr('id');
         $.ajax({
            url: "./php_controler/data_fetch.php",
            method: "POST",
            data: {
               encrition_id: encrition_id
            },
            dataType: 'json',
            success: function(data) {
               // alert(data[0].sub_cat_id);
               localStorage.setItem("name", data[0].cake_flavor_types);
               localStorage.setItem("total_price", data[0].total_price);
               localStorage.setItem("discount", data[0].discount);
               var options = {
                  ajaxPrefix: ''
               };
               new Dialogify('./php_controler/edit_data.php', options)
                  .title("Edit Cake Flavor Info")
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
                           var discount_v = $('#discount_offer').val();
                           var valid_dis = /(^[0-9]{1,2}%{1}$)/m;

                           if (!valid_dis.test(discount_v)) {
                              alert( "You have to input one or two number and one % as discount");
                           }
                           else { 
                              
                           var form_data = new FormData();
                           form_data.append('name', $('#cake_name').val());
                           form_data.append('total_price', $('#total_price').val());
                           form_data.append('discount', discount_v);
                           form_data.append('id', data[0].cake_id);
                           // alert(JSON.stringify(form_data));
                           $.ajax({
                              method: "POST",
                              url: './php_controler/edit.php',
                              data: form_data,
                              // dataType:'json',
                              contentType: false,
                              cache: false,
                              processData: false,
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
                     }
                  ]).showModal();
            }
         });

      });
   });

   

   // delete 
   // delete 
   // delete 

    $(document).ready(function() {
      $(".Del_btn").on("click", function() {

         document.getElementById("msg").style.display = "none";
         document.getElementById("errmsg").style.display = "none";

         alert("Are you sure??Your data will deleted permanently!");
         var encrition_id = $(this).attr('id');
         
         $.ajax(
            {
               url:"./php_controler/delete.php",
               method:"POST",
               data:{encrition_id:encrition_id},
               success:function(data){
                  alert(data);

                  $.ajax({
                  cache: false,
                  url: "./php_controler/shows.php",
                  method: "POST",
                  success: function(data) {
                     $("#show_data").html(data);
                  }
               });

               }
            }
         )

          });
         });
     

      
      
</script>