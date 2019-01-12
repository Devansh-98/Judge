<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$otp=$otp_err="";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["otp"]))){
        $otp_err = "Please enter correct OTP.";
    } else{
        $otp = trim($_POST["otp"]);
    }
    
    // Validate credentials
    if(empty($otp_err)){
        // Prepare a select statement
        $sql = "SELECT username,profilename,password,email,city,state,country,occupation,gender,motto,college FROM node WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $_SESSION["username"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                 // Bind result variables
                mysqli_stmt_bind_result($stmt,$username,$profilename, $hashed_password,$email,$city,$state,$country,$occupation,$gender,$motto,$college);
                if(mysqli_stmt_fetch($stmt))
                {
                    if($_SESSION["var"]==$otp)
                    {
                        session_start();
                            
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $username;
                        $_SESSION["profilename"] = $profilename; 
                        $_SESSION["email"] = $email; 
                        $_SESSION["city"] = $city; 
                        $_SESSION["state"] = $state; 
                        $_SESSION["country"] = $country;        
                        $_SESSION["occupation"] = $occupation;
                        $_SESSION["gender"] = $gender; 
                        $_SESSION["motto"] = $motto;
                        $_SESSION["college"]=$college;
                        header("location: welcome.php");
                    }
                    else
                    {
                        $otp_err="Please enter correct OTP.";
                    }
                }
            }
             else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <p>Please enter otp.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($otp_err)) ? 'has-error' : ''; ?>">
                <label>OTP</label>
                <input type="text" name="otp" class="form-control" value="<?php echo $otp; ?>">
                <span class="help-block"><?php echo $otp_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <a href="forgotPassword.php">Forgot password?</a>
        </form>
    </div>    
</body>
</html>