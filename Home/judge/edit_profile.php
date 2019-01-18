<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username =$_SESSION["username"];
$profilename =$_SESSION["profilename"];
$college =$_SESSION["college"];
$city =$_SESSION["city"];
$state =$_SESSION["state"];
$country = $_SESSION["country"];
$occupation = $_SESSION["occupation"];
$gender =$_SESSION["gender"];
$motto = $_SESSION["motto"];

$username_err = $profilename_err =$college_err = $city_err = $state_err = $country_err = $occupation_err = $gender_err = $motto_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["profilename"]))){
        $profilename_err = "Please enter a Profile Name.";     
    } elseif(strlen(trim($_POST["profilename"])) > 50){
        $profilename_err = "Profile Name must be less than 50 characters.";
    } else{
        $profilename = trim($_POST["profilename"]);
    }
    
    if(empty(trim($_POST["college"]))){
        $college_err = "Please enter a College Name.";     
    } elseif(strlen(trim($_POST["college"])) > 100){
        $college_err = "College Name must be less than 100 characters.";
    } else{
        $college = trim($_POST["college"]);
    }

    if(empty(trim($_POST["city"]))){
        $city_err = "Please enter your City Name.";     
    } elseif(strlen(trim($_POST["city"])) > 50){
        $city_err = "City Name must be less than 50 characters.";
    } else{
        $city = trim($_POST["city"]);
    }

    if(empty(trim($_POST["state"]))){
        $state_err = "Please enter your State Name.";     
    } elseif(strlen(trim($_POST["state"])) > 50){
        $state_err = "State Name must be less than 50 characters.";
    } else{
        $state = trim($_POST["state"]);
    }

    if(empty(trim($_POST["country"]))){
        $country_err = "Please enter your Country.";     
    } elseif(strlen(trim($_POST["country"])) > 50){
        $country_err = "Country Name must be less than 50 characters.";
    } else{
        $country = trim($_POST["country"]);
    }

    if(empty(trim($_POST["occupation"]))){
        $occupation_err = "Please enter your Occupation.";     
    } elseif(strlen(trim($_POST["occupation"])) > 200){
        $occupation_err = "Occupation name must be less than 200 characters.";
    } else{
        $occupation = trim($_POST["occupation"]);
    }

    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please enter your Gender";     
    } elseif(strlen(trim($_POST["gender"])) > 50){
        $gender_err = "Gender must be less than 50 characters.";
    } else{
        $gender = trim($_POST["gender"]);
    }

    if(empty(trim($_POST["motto"]))){
        $motto_err = "Kuch motto nhi h BheNchod";     
    } elseif(strlen(trim($_POST["motto"])) > 150){
        $motto_err = "Motto must be less than 150 characters.";
    } else{
        $motto = trim($_POST["motto"]);
    }


    // Check input errors before inserting in database
    if( empty($profilename_err) && empty($college_err)&& empty($city_err)&& empty($state_err)&& empty($country_err)&& empty($occupation_err)&& empty($gender_err)&& empty($motto_err)){
        
        // Prepare an insert statement
        $sql = "UPDATE node SET profilename=?,college=?,city=?,state=?,country=?,occupation=?,gender=?,motto=? WHERE username = ?";
         
            echo "suskjdb";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_profilename,$param_college,$param_city,$param_state,$param_country,$param_occupation,$param_gender,$param_motto,$param_username);
            
            // Set parameters
            $param_username=$username;
            $param_profilename = $profilename;
            $param_college = $college;
            $param_city = $city;
            $param_state = $state;
            $param_country = $country;
            $param_occupation = $occupation;
            $param_gender = $gender;
            $param_motto = $motto;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Edit Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($profilename_err)) ? 'has-error' : ''; ?>">
                <label>Profile Name</label>
                <input type="text" name="profilename" class="form-control" value="<?php echo $profilename; ?>">
                <span class="help-block"><?php echo $profilename_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($college_err)) ? 'has-error' : ''; ?>">
                <label>College</label>
                <input type="text" name="college" class="form-control" value="<?php echo $college; ?>">
                <span class="help-block"><?php echo $college_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                <span class="help-block"><?php echo $state_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($country_err)) ? 'has-error' : ''; ?>">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
                <span class="help-block"><?php echo $country_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($occupation_err)) ? 'has-error' : ''; ?>">
                <label>Occupation</label>
                <input type="text" name="occupation" class="form-control" value="<?php echo $occupation; ?>">
                <span class="help-block"><?php echo $occupation_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label>Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($motto_err)) ? 'has-error' : ''; ?>">
                <label>Motto</label>
                <input type="text" name="motto" class="form-control" value="<?php echo $motto; ?>">
                <span class="help-block"><?php echo $motto_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>