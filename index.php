<?php
include("./Module/DB_conn.php");


function check($data){
 $data = htmlspecialchars($data);
 $data = stripslashes($data);
 $data = trim($data);
 return $data;
}


if(isset($_POST['btn'])){

  if(empty($_POST['username'] && $_POST['password'])){

    $err = "<p style='color: red;'>Fill up the Username and Password</p>";
    
  }
  else{

    $user_name = check($_POST['username']);
    $passwordpp = check($_POST['password']);

    $sql = "SELECT * FROM `login`";
    $execute = mysqli_query($conn,$sql);
    if($execute){
        $row = mysqli_fetch_assoc($execute);
        $username_db = $row['username'];
        $password_db = $row['passwords'];
        if($user_name ==$username_db){

            if($passwordpp==$password_db){
                header('Location: ./admin/index.php');
            }else{
                $err = "<p style='color: red;'>Password don't match</p>";
            }


        }else{
            $err = "<p style='color: red;'>Username don't match</p>";
        }

    }else{
        $err = "<p style='color: red;'>Don't connect with database</p>";
    }

  }

}



?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>

    <body>

        <div class="container">
            <div class="card card-login mx-auto text-center bg-dark">
                <div class="card-header mx-auto bg-dark">
                    <!-- <span id="img"> <img id="img" style="width: 15px;" src="./admin/img/352-3522106_home-dashboard-alternate-home-loans-logo.png" class="w-75" alt="Logo"> </span><br/> -->
                    <span class="logo_title mt-5"> Login Dashboard </span>
                    <!--            <h1>-->
                    <?php //echo $message?>
                    <!--</h1>-->

                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($user_name)){ echo $user_name;}?>">
                            
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <?php
                        if(isset($err)){
                            echo $err;
                        }

                        ?>
                        <div class="form-group">
                            <input type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>