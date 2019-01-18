<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
}
$servername = "localhost";
$username = "judge";
$password = "AsdfgH@29";
$dbname = "judge_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo $_SESSION["username"];
$query1="select correct_answer, wrong_answer from node where username=\"".$_SESSION["username"]."\";";
// echo $query1;
$result1=$conn->query($query1);
while($row = $result1->fetch_assoc()) {
  $correct=explode(";",$row["correct_answer"]);
  $wrong=explode(";",$row["wrong_answer"]);
}

$sql = "SELECT * FROM problems_db";
// echo "<div class='container'>";
  echo "<div class='white-box'>";
echo "<center><h1>Hi ".$_SESSION["username"].", We are gonna Judge You.</h1>";

   
$result = $conn->query($sql);
echo "<center><table border='4'font-size: 24px; style='color: blue;'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<center><th>Problem ID</th><th> Problem Name</th><th>Time Limit</th><th> Accuracy</th><br>";
    while($row = $result->fetch_assoc()) {
      $flag=false;
      $arrlength=count($correct);
      echo "<tr style='font-size: 34px;'>";
      for($x=0;$x<$arrlength;$x++)
      {
        if ($correct[$x]===$row["prob_id"])
        {
          echo "<tr style='font-size: 34px;color:green;background-color:#33ff33;'>";
          $flag=true;
          break;

        }
      }
      if($flag===false)
      {
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($wrong[$x]===$row["prob_id"])
          {
            echo "<tr style='font-size: 34px;color:red;'>";
            $flag=true;
            break;
          }
        }
      }
      if($row["wrong_submission"]==="0")
      {
        $accuracy=0;
      }
      else{
        $accuracy=(float)$row["correct_submission"]/((float)$row["wrong_submission"]+(float)$row["correct_submission"]);
      }
      echo "<center><a href='../../problemset/".$row["prob_id"]."/'>";
        echo "<td><center><a href='../../problemset/".$row["prob_id"]."/'>".$row["prob_id"]."</a></td><td><center> ".$row["prob_name"]."</td><td><center> ".$row["time_limit"]."</td><td><center> ".number_format($accuracy,4)."</td><br>";
      echo  "</a>";
    }
} else {
    echo "0 results";
}
 echo "</table>";
// echo "</div>";
echo "</div>";
//echo "<a href = 'logout.php'>LOG OUT</a>";
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- <meta charset="UTF-8"> -->
    <!-- <title>Welcome</title> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <link rel="stylesheet" type="text/css" href="try1.css">

    
</head>
<body>

    <div class="navbar">
      <a href="#home">Home</a>
      <div class="topnav-right">
        <><a href="profile.php">Profile</a>
        <a href="reset_password.php">Reset Password</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
        
    
</body>
</html>