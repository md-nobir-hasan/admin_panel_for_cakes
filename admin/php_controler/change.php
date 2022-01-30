<?php
include("../../Module/DB_conn.php");


function check($data){
 $data = htmlspecialchars($data);
 $data = stripslashes($data);
 $data = trim($data);
 return $data;
}


if(isset($_POST['button'])){

  if(empty($_POST['username'] && $_POST['password'] && $_POST['name_fav'])){

    $err = "<p style='color: red;'>**Fill up the Username and Password</p>";
    
  }
  else{

    $name_fav = check($_POST['name_fav']);
    $user_name = check($_POST['username']);
    $passwordpp = check($_POST['password']);

	$pattern_user = "/(^[a-z]{3,6}$)/mi";
    $pattern_pass = "/(^[a-z-0-9]*$)/mi";
    $valid_user = preg_match($pattern_user,$user_name);
    $valid_pass = preg_match($pattern_pass,$passwordpp);


    $sql = "SELECT * FROM `login`";
    $execute = mysqli_query($conn,$sql);
    if($execute){
        $row = mysqli_fetch_assoc($execute);

        $name_fav_db = $row['helper_password'];
        // header('Location: ./index.php');
        // echo $name_fav;

        if($name_fav == $name_fav_db){

		if($valid_user){

			if($valid_pass){

			$sq = "UPDATE login SET username ='{$user_name}',passwords='{$passwordpp}'";
			$execute = mysqli_query($conn,$sq);
			if($execute){
				$err = "<p style='color: green;'>**Successfully updated</p>";
				header('Location: ../index.php');

			}else{
				$err = "<p style='color: green;'>**Update query don't execute </p>";
			}


			}else{
				$err = "<p style='color: red;'>**Only letter and number can <br> be entered as password</p>";
			}


		}else{
			$err = "<p style='color: red;'>**Only three to six letter can <br> be inputed as username</p>";
		}

        }
		else{
            $err = "<p style='color: red;'>**The name don't match with your favourite name</p>";
        }


    }else{
        $err = "<p style='color: red;'>**Don't connect with database</p>";
    }
  }

}
// else{
//     $err = "<p style='color: red;'>btn is not set</p>";
// }



?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Update password</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 align='center'>Update username and password</h3>
			</div>
			<div class="card-body">
				<form  method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="bi bi-person-badge">N</i></span>
						</div>
						<input type="text" name="name_fav" class="form-control" placeholder="Enter the favourite name that you entered before" value="<?php if(isset($name_fav)){ echo $name_fav;} ?>">
						</div>


					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($user_name)){ echo $user_name;} ?>">
						</div>


					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
                   
					<div class="form-group">
						<input type="submit" name="button" value="Update" class="btn float-right login_btn">
					</div>
                    <?php
                    if(isset($err)){
                        echo $err;
                    }
                    ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>