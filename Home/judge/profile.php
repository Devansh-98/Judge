<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="try.css">
    
    <meta charset="UTF-8">
    <title>Welcome</title>
   
</head>
<body>

    <div class="navbar"> 
      <div class="topnav-left">
        <a href="welcome.php">Home</a>
        <!-- <a href="#news">News</a> -->
      </div>
      <div class="topnav-right">
      <a href="edit_profile.php">Edit Profile</a>
        <a href="reset_password.php">Reset Password</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>

    

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

   
    
    <!------ Include the above in your HEAD tag ---------->

    <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <div class="profile-img">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="file"/>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                        </br>
                                        </br>
                                        <h2>
                                            <?php echo $_SESSION["profilename"]; ?>
                                        </h2> 
                                        </br>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>User Id</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["username"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Country</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["country"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>State</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["state"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>City</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["city"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>College/Organisation</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["college"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["email"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Gender</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["gender"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Motto</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["motto"];?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Profession</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?php echo $_SESSION["occupation"];?></p>
                                                </div>
                                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>           
            </div>
    
</body>
</html>