     <?php
        include("../../Module/DB_conn.php");
        ?>
     <?php
        // $cat_name = $cat_code = "";
        //  if($_SERVER["REQUEST_METHOD"]=="POST"){
        $id = $_POST['id'];
        // $name = $_POST['name'];
        // $code = $_POST['code'];

        $success = $err = $exist = '';


        function check($input_value)
        {
            $data = htmlspecialchars($input_value);
            $data = stripslashes($input_value);
            $data = trim($input_value);
            return $data;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = check($_POST["name"]);
            $total_price = check($_POST["total_price"]);
            $discount = check($_POST["discount"]);

            $sql1 = "SELECT * FROM cake_flavor_info WHERE cake_flavor_types='$name' ";
            $execute1 = mysqli_query($conn, $sql1);
            if ($execute1->num_rows > 0) {
                echo "These values are existed";
            } else {

                $sql = "UPDATE cake_flavor_info SET cake_flavor_types='$name',total_price='$total_price',discount='$discount'  WHERE cake_id ='$id'";
                $statment = mysqli_query($conn, $sql);
                if ($statment) {

                    $success = "Sucessfully Updaded";
                    echo $success;
                    // header("location: ../sub_category.php");
                } else {
                    $err = "Opps err";
                    echo $err;
                }
            }
        }








        ?>
