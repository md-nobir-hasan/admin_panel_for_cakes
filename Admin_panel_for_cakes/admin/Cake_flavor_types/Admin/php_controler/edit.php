     <?php
        //Database connection
        include("../../Module/DB_conn.php");
        ?>
     <?php
        $id = $_POST['id'];

        $success = $err = $exist = '';

        //checking and validation of inputed value
        function check($input_value)
        {
            $data = htmlspecialchars($input_value);
            $data = stripslashes($input_value);
            $data = trim($input_value);
            return $data;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = check($_POST["name"]); //cake flavor types name
            $total_price = check($_POST["total_price"]);
            $discount = check($_POST["discount"]);


            //for below codes,one can't insert one value twice.in word cake flavor types remain unique
            $sql1 = "SELECT * FROM cake_flavor_info WHERE cake_flavor_types='$name' ";
            $execute1 = mysqli_query($conn, $sql1);
            if ($execute1->num_rows > 0) {
                echo "These values are existed";
            } else {

                //update cake info query
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
