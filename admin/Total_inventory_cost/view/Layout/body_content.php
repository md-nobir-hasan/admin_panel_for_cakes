<?php
include("../Module/DB_conn.php");
$output1 = "";
$sql1 = $sql2 = "SELECT * FROM `cake_flavor_info`";
$execute1 = mysqli_query($conn, $sql1);


if ($execute1) {
    while ($row = mysqli_fetch_assoc($execute1)) {
        $id = $row['cake_id'];
        $name = $row['cake_flavor_types'];
        $output1 .= "<option value='" . $name . "' id=''>" . $name . "</option>";
    }
}
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <h3>Add Total Inventory Cost</h3>
            </div>

            <form class="shadow p-4">
                <div class="mb-3">
                    <label for="cake_name">Cake Flavour Name</label><span style='color:red' ;> * </span>

                    <select class="form-control" name="cake_name" id="cake_name" value=" ">
                       <option value="">Select A cake Name</option>
                       <?php
                        echo $output1;
                        ?>

                    </select>
                </div>
                <span id="emp_name" style="color:red;"></span>

                <div class="mb-3">
                    <label for="material_c">Raw Material Cost</label><span style='color:red' ;> * </span>
                    <input type="number" class="form-control" name="material_c" id="material_c" placeholder="Material Cost">
                    <span id="emt_material_c" style="color:red;"></span>
                </div>

                <div class="mb-3">
                    <label for="trta_c">Transportation Cost</label><span style='color:red' ;> * </span>

                    <input type="number" value="" class="form-control" name="trta_c" id="trta_c" placeholder="Transpertation Cost">
                    <span id="empty_trta_c" style="color:red;"></span>
                </div>

                <div class="mb-3">
                    <label for="ul_c">Utility Cost</label><span style='color:red' ;> * </span>

                    <input type="text" value="" class="form-control" name="ul_c" id="ul_c" placeholder="Utility Cost">
                    <span id="em_ul_c" style="color:red;"></span>
                </div>

                <div class="mb-3">
                    <label for="sp_c">Space Cost</label><span style='color:red' ;> * </span>

                    <input type="number" value="" class="form-control" name="sp_c" id="sp_c" placeholder="Space Cost">
                    <span id="em_sp_c" style="color:red;"></span>
                </div>

                <div class="mb-3">
                    <label for="st_c">Staff Cost</label><span style='color:red' ;> * </span>

                    <input type="number" value="" class="form-control" name="st_c" id="st_c" placeholder="Staff Cost">
                    <span id="em_st_c" style="color:red;"></span>
                </div>


                <div class="mb-3">
                    <span id="msg" style="display: none;">Data Successfully Inserted</span>
                    <button type="button" class="btn btn-primary" onclick="DataInsert()" >Add</button>
                    <br>
                    <span id="emptyAll" style="color:red;"></span>
                </div>
                <span id="errmsg" style="display: none; color:red">Data is not inserted</span>



            </form>
        </div>
        <div>

            <!-- //^Show Table -->
            <div class="container">
                <h2 id="show_div">Show Data</h2>
                <div id="show_data">

                </div>
                <!-- <table class="table table-hover">
    <thead>
    <tr id="show_divt" style="display: none;">
        <th>Categories Name</th>
        <th align="center">Categories Code</th>
      </tr>
    </thead>
    <tbody>
    <tr id="show_data">
     
    </tr>
   //show data from show.php by javascript
    </tbody>
  </table> -->
            </div>
        </div>
    </div>
</div>