<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <h3>Add Cake Flavor Types</h3>
            </div>
            <!-- empty all message -->
            <span id="emptyAll" style="color:red;"></span>

            <!-- Cake flavor types name input -->
            <form class="shadow p-4">
                <div class="mb-3">
                    <label for="name">Cake Flavor Types Name</label><span style='color:red' ;> * </span>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Cake Flavor Name">
                    <!-- message of empty name -->
                    <span id="emptyName" style="color:red;"></span>
                </div>

                <!-- Total price input -->
                <div class="mb-3">
                    <label for="price">Total Price</label><span style='color:red' ;> * </span>
                    <input type="number" value="" class="form-control" name="price" id="price" placeholder="Cake Price">
                    <!-- message of empty code -->
                    <span id="emptyCode" style="color:red;"></span>
                </div>

                <!-- discount input -->
                <div class="mb-3">
                    <label for="discount">Discount</label><span style='color:red' ;> * </span>

                    <input type="text" value="" class="form-control" name="discount" id="discount" placeholder="Exp:3%,0%">
                    <!-- message of empty details  -->
                    <span id="emptydetails" style="color:red;"></span>
                </div>

                <!--add button and DataInsert() function        -->
                <div class="mb-3">
                    <!-- success message -->
                    <span id="msg" style="display: none;">Data Successfully Inserted</span>
                    <button type="button" class="btn btn-primary" onclick="DataInsert()">Add</button>
                </div>
                <!-- err message -->
                <span id="errmsg" style="display: none; color:red">Data is not inserted</span>



            </form>
        </div>
        <div>

            <!-- //^Show Table -->
            <div class="container">
                <h2 id="show_div">Show Data</h2>
                <div id="show_data">

                </div>

            </div>
        </div>
    </div>
</div>