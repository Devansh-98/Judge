<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values

$username = $profilename = $email = $college = $city = $state = $country = $occupation = $gender = $motto = "";
$username_err = $profilename_err = $email_err = $college_err = $city_err = $state_err = $country_err = $occupation_err = $gender_err = $motto_err = "";


$password = $confirm_password = "";
$password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT username FROM node WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }


    if(empty(trim($_POST["profilename"]))){
        $profilename_err = "Please enter a Profile Name.";
    } elseif(strlen(trim($_POST["profilename"])) > 50){
        $profilename_err = "Profile Name must be less than 50 characters.";
    } else{
        $profilename = trim($_POST["profilename"]);
    }



    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a E-mail.";
    } else{
        $valid_check = trim($_POST["email"]);
        if(!filter_var($valid_check, FILTER_VALIDATE_EMAIL))
        {
            $email_err = "Please enter a Valid E-mail.";

        }
        else
        {
        
        // Prepare a select statement
        $sql = "SELECT username FROM node WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This E-mail is already in use.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($profilename_err) && empty($email_err) && empty($college_err)&& empty($city_err)&& empty($state_err)&& empty($country_err)&& empty($occupation_err)&& empty($gender_err)&& empty($motto_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO node (username, profilename, password,email,college,city,state,country,occupation,gender,motto,correct_answer,wrong_answer) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $param_username,$param_profilename, $param_password,$param_email,$param_college,$param_city,$param_state,$param_country,$param_occupation,$param_gender,$param_motto,$wa,$ca);

            // Set parameters
            $param_username = $username;
            $param_profilename = $profilename;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_college = $college;
            $param_city = $city;
            $param_state = $state;
            $param_country = $country;
            $param_occupation = $occupation;
            $param_gender = $gender;
            $param_motto = $motto;
            $ca=";";
            $wa=";";


            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($profilename_err)) ? 'has-error' : ''; ?>">
                <label>Profile Name</label>
                <input type="text" name="profilename" class="form-control" value="<?php echo $profilename; ?>">
                <span class="help-block"><?php echo $profilename_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
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
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
