<?php
//Database connection
include("../../Module/DB_conn.php");

$output = '';

$output .= " <div>
  <table class='table table-hover'>
  <thead>
  <tr>
        <th>Cake Name</th>
        <th>Raw Materail Cost</th>
        <th>Transportation Cost</th>
        <th>Utility Cost</th>
        <th>Space Cost</th>
        <th>Staff Cost</th>
        <th>Total Cost</th>
        <th>Edit</th>
        <th>Delete</th>
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

      $output .= "<tbody>
                  <tr>

                  <td class='" . $encript_id . "'>" . $row['cake_flavor_types'] . "</td>
                  <td class='" . $encript_id . "'>" . $row['material_cost'] . "</td>
                  <td class='" . $encript_id . "'>" . $row['transportation_cost'] . "</td>
                  
                  <td class='" . $encript_id . "'>" . $row['utility_cost'] . "</td>
                  <td class='" . $encript_id . "'>" . $row['space_cost'] . "</td>
                  <td class='" . $encript_id . "'>" . $row['staff_cost'] . "</td>

                  <td class='" . $encript_id . "'>" . $row['total_cost'] . "</td>

                  <td> <button id='{$encript_id}' class='edit btn btn-success' >Edit</button> </td>
                  
                  <td class='Del_btn btn btn-danger' id='" . $encript_id . "'>Delete</td>
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
   //
   //edit total inventory cost
   //
   $(document).ready(function() {
      $(".edit").on("click", function() {
         var encription_id = $(this).attr('id');

         $.ajax({
            url: "./php_controler/data_fetch.php",
            method: "POST",
            data: {
               encription_id: encription_id
            },
            dataType: 'json',
            success: function(value) {
               // alert(value[0].utility_cost);
               localStorage.setItem("cost_id", value[0].cost_id);
               localStorage.setItem("cake_name", value[0].cake_flavor_types);
               localStorage.setItem("material_cost", value[0].material_cost);
               localStorage.setItem("transportation_cost", value[0].transportation_cost);
               localStorage.setItem("utility_cost", value[0].utility_cost);
               localStorage.setItem("space_cost", value[0].space_cost);
               localStorage.setItem("staff_cost", value[0].staff_cost);
               localStorage.setItem("total_cost", value[0].total_cost);

               var options = {
                  ajaxPrefix: ''
               };
               new Dialogify('./php_controler/model_body.php', options)
                  .title("Edit inventory cost")
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
                           var utility_pce = $('#utility_cost').val(); //Utility in percentage

                           var pattern_disc = /(^[0-9]{1,2}%{1}$)/m; //regex for discount validation

                           if (!pattern_disc.test(utility_pce)) {
                              alert("You have to input one or two number and one % as discount");
                           } else {
                              var form_data = new FormData();
                              form_data.append('cake_name_m', $('#cake_name_model').val());
                              form_data.append('material_cost', $('#material_cost').val());
                              form_data.append('transportation_cost', $('#transportation_cost').val());
                              form_data.append('utility_cost', utility_pce);
                              form_data.append('space_cost', $('#space_cost').val());
                              form_data.append('staff_cost', $('#staff_cost').val());
                              form_data.append('cost_id', value[0].cost_id);
                              // alert(JSON.stringify(form_data));
                              $.ajax({
                                 method: "POST",
                                 url: './php_controler/edit.php',
                                 data: form_data,
                                 // dataType:'json',
                                 contentType: false,
                                 cache: false,
                                 processData: false,
                                 success: function(data) {
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
                              });
                           }
                        }
                     }

                  ]).showModal();

            }

         });
      });
   });


   //
   //Delete
   //
   $(document).ready(function() {
      $(".Del_btn").on("click", function() {

         document.getElementById("msg").style.display = "none";
         alert("Are you sure??Your data will deleted permanently!");
         var encrition_id = $(this).attr('id');

         $.ajax({
            url: "./php_controler/delete.php",
            method: "POST",
            data: {
               encrition_id: encrition_id
            },
            success: function(data) {
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
         })

      });
   });
</script>