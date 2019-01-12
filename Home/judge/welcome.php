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
$result = $conn->query($sql);
echo "<center><table border='4'font-size: 24px; style='color: blue;'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<th>Problem ID</th><th> Problem Name</th><th>time_limit</th><th> accuracy</th><br>";
    while($row = $result->fetch_assoc()) {
      $flag=false;
      $arrlength=count($correct);
      echo "<tr style='font-size: 34px;'>";
      for($x=0;$x<$arrlength;$x++)
      {
        if ($correct[$x]===$row["prob_id"])
        {
          echo "<tr style='font-size: 34px;color:green;'>";
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
      echo "<a href='../../problemset/".$row["prob_id"]."/'>";
        echo "<td><a href='../../problemset/".$row["prob_id"]."/'>".$row["prob_id"]."</a></td><td> ".$row["prob_name"]."</td><td> ".$row["time_limit"]."</td><td> ".$accuracy."</td><br>";
      echo  "</a>";
    }
} else {
    echo "0 results";
}
//echo "<a href = 'logout.php'>LOG OUT</a>";
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        /* Navbar container */
        .navbar {
          overflow: hidden;
          background-color: #333;
          font-family: Arial;
        }

        /* Links inside the navbar */
        .navbar a {
          float: left;
          font-size: 16px;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
        }

        /* The dropdown container */
        .dropdown {
          float: left;
          overflow: hidden;
        }

        /* Dropdown button */
        .dropdown .dropbtn {
          font-size: 16px; 
          border: none;
          outline: none;
          color: white;
          padding: 14px 16px;
          background-color: inherit;
          font-family: inherit; /* Important for vertical align on mobile phones */
          margin: 0; /* Important for vertical align on mobile phones */
        }

        /* Add a red background color to navbar links on hover */
        .navbar a:hover, .dropdown:hover .dropbtn {
          background-color: red;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
          float: none;
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          text-align: left;
        }

        /* Add a grey background color to dropdown links on hover */
        .dropdown-content a:hover {
          background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
          display: block;
        }

        .btn {
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
        }

        .success {background-color: #4CAF50;} /* Green */
        .success:hover {background-color: #46a049;}

        .info {background-color: #2196F3;} /* Blue */
        .info:hover {background: #0b7dda;}

        .warning {background-color: #ff9800;} /* Orange */
        .warning:hover {background: #e68a00;}

        .danger {background-color: #f44336;} /* Red */ 
        .danger:hover {background: #da190b;}

        .default {background-color: #e7e7e7; color: black;} /* Gray */ 
        .default:hover {background: #ddd;}
        .topnav-right {
          float: right;
        }
    </style>
</head>
<body>

    <div class="navbar">
      <a href="#home">Home</a>
      <div class="topnav-right">
        <a href="profile.php">Profile</a>
        <a href="reset_password.php">Reset Password</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> We are gonna Judge You.</h1>
    </div>

</body>
</html>