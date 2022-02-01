<?php
//Databse connection
include("../../Module/DB_conn.php");


$output1 = "";

//this query for showing cake flavor types name
$sql = "SELECT * FROM `cake_flavor_info`";
$execute = mysqli_query($conn, $sql);
if ($execute) {
    while ($row = mysqli_fetch_assoc($execute)) {
        $id = $row['cake_id'];
        $name = $row['cake_flavor_types'];
        $output1 .= "<option value='" . $name . "' id=''>" . $name . "</option>";
    }
}
?>


<div class="container mt-5">
    <div class="mb-3">
        <h3>Updaded Total Inventory Cost</h3>
    </div>
    <!-- Cake flavor types select box -->
    <form class="shadow p-4">
        <div class="mb-3">
            <label for="cake_name_m">Cake Flavor Name</label><span style='color:red' ;> * </span>

            <select class="form-control" name="cake_name_m" id="cake_name_model" value=" ">
                <option value="">Select A cake Name</option>
                <?php
                echo $output1;
                ?>

            </select>
        </div>
        <!-- message for empty cake flavor types  -->
        <span id="emp_name" style="color:red;"></span>

        <!-- Raw material cost input  -->
        <div class="mb-3">
            <label for="material_cost">Raw Material Cost</label><span style='color:red' ;> * </span>
            <input type="number" class="form-control" name="material_cost" id="material_cost" placeholder="Material Cost">
            <span id="emt_material_cost" style="color:red;"></span>
        </div>

        <!-- Transportation cost input  -->
        <div class="mb-3">
            <label for="transportation_cost">Transportation Cost</label><span style='color:red' ;> * </span>
            <input type="number" value="" class="form-control" name="transportation_cost" id="transportation_cost" placeholder="Transpertation Cost">
            <span id="empty_transportation_cost" style="color:red;"></span>
        </div>

        <!-- Utility cost input  -->
        <div class="mb-3">
            <label for="utility_cost">Utility Cost</label><span style='color:red' ;> * </span>
            <input type="text" value="" class="form-control" name="utility_cost" id="utility_cost" placeholder="Utility Cost">
            <span id="em_utility_cost" style="color:red;"></span>
        </div>

        <!-- Space cost input -->
        <div class="mb-3">
            <label for="sp_c">Space Cost</label><span style='color:red' ;> * </span>
            <input type="number" value="" class="form-control" name="space_cost" id="space_cost" placeholder="Space Cost">
            <span id="em_space_cost" style="color:red;"></span>
        </div>

        <!-- Staff cost  -->
        <div class="mb-3">
            <label for="staff_cost">Staff Cost</label><span style='color:red' ;> * </span>
            <input type="number" value="" class="form-control" name="staff_cost" id="staff_cost" placeholder="Staff Cost">
            <span id="em_staff_cost" style="color:red;"></span>
        </div>

    </form>


</div>


<script>
    $(document).ready(function() {
        var cost_id = localStorage.getItem('cost_id');
        var cake_name = localStorage.getItem('cake_name');
        var material_cost = localStorage.getItem('material_cost');
        var transportation_cost = localStorage.getItem('transportation_cost');
        var utility_cost = localStorage.getItem('utility_cost');
        var space_cost = localStorage.getItem('space_cost');
        var staff_cost = localStorage.getItem('staff_cost');
        var total_cost = localStorage.getItem('total_cost');
        // alert(name);
        // alert(total_price);
        // alert(discount);
        // document.getElementById("nobir").innerHTML = "yes possible";
        // $('#nobir').html("name");
        // alert(name);
        //var id = localStorage.getItem('id');
        $('#material_cost').val(material_cost);
        $('#transportation_cost').val(transportation_cost);
        $('#utility_cost').val(utility_cost);

        $('#space_cost').val(space_cost);
        $('#staff_cost').val(staff_cost);
    });
</script>