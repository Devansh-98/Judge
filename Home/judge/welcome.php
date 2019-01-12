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
echo "<a href = 'logout.php'>LOG OUT</a>";
$conn->close();
?>
