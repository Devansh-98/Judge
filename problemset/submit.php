<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
  header("location: ../Home/judge/login.php");
  exit;
}
if(isset($_FILES['srcCode'])){
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
  $errors= array();
  $file_name = $_FILES['srcCode']['name'];
  $file_size =$_FILES['srcCode']['size'];
  $file_tmp =$_FILES['srcCode']['tmp_name'];
  $file_type=$_FILES['srcCode']['type'];
  $prob_code=$_POST['prob_code'];
  $time_limit=$_POST['time_limit'];
  $file_ext=strtolower(end(explode('.',$_FILES['srcCode']['name'])));
  $language= $_POST['Language'];
  if(empty($errors)==true){
    if(move_uploaded_file($file_tmp,$prob_code."/uploads/".$file_name))
    {
      $query='bash evaluate.sh '.$language.' '.$file_name.' '.$prob_code.' '.$time_limit;
    #  echo $query;
      exec($query,$o,$r);
      switch ($r) {
        case '0':
        echo "Correct Answer";
        $query="select correct_submission from problems_db where prob_id = '".$prob_code."';";
        $result=$conn->query($query);
        while($row = $result->fetch_assoc())
        {
          $wac=(string)((int)$row["correct_submission"]+1);
          $query="UPDATE problems_db set correct_submission='".$wac."'where prob_id = '".$prob_code."';";
          if ( $conn->query($query)=== TRUE) {
          } else {
            echo "Error updating record: " . $conn->error;
          }
        }
        $flag=false;
        $ca="";
        $wa="";
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($correct[$x]===$prob_code)
          {
            $flag=true;
            break;
          }
        }
        if($flag===false)
        {
          $arrlength=count($wrong);
          for($x=0;$x<$arrlength;$x++)
          {
            if ($wrong[$x]===$prob_code)
            {
              $wrong[$x]="";
            }
          }
          $ca=$ca.$prob_code.";";
        }
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if($wrong[$x]==="")
          continue;
          $wa=$wa.$wrong[$x].';';
        }
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if($correct[$x]==="")
          continue;
          $ca=$ca.$correct[$x].';';
        }
        break;
        case '1':
        echo "Wrong Answer";
        $query="select wrong_submission from problems_db where prob_id = '".$prob_code."';";
        $result=$conn->query($query);
        while($row = $result->fetch_assoc())
        {
          $wac=(string)((int)$row["wrong_submission"]+1);
          $query="UPDATE problems_db set wrong_submission='".$wac."'where prob_id = '".$prob_code."';";
          if ( $conn->query($query)=== TRUE) {
          } else {
            echo "Error updating record: " . $conn->error;
          }
        }
        $flag=false;
        $ca="";
        $wa="";
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($correct[$x]===$prob_code)
          {
            $flag=true;
            break;
          }
        }
        if($flag===false)
        {
          $arrlength=count($wrong);
          for($x=0;$x<$arrlength;$x++)
          {
            $flag=true;
          }
        }
        if($flag===false)
        {
          $wa=$wa.$prob_code.";";
        }
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if($wrong[$x]==="")
          continue;
          $wa=$wa.$wrong[$x].';';
        }
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if($correct[$x]==="")
          continue;
          $ca=$ca.$correct[$x].';';
        }
        break;
        case '2':
        echo "compile time error<br>";
        $query="select wrong_submission from problems_db where prob_id = '".$prob_code."';";
        $result=$conn->query($query);
        while($row = $result->fetch_assoc())
        {
          $wac=(string)((int)$row["wrong_submission"]+1);
          $query="UPDATE problems_db set wrong_submission='".$wac."'where prob_id = '".$prob_code."';";
          if ( $conn->query($query)=== TRUE) {
          } else {
            echo "Error updating record: " . $conn->error;
          }
        }
        $flag=false;
        $ca="";
        $wa="";
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($correct[$x]===$prob_code)
          {
            // echo $x."<br>";
            // echo $correct[$x]."<br>";
            $flag=true;
            break;
          }
        }
        if($flag===false)
        {
          $arrlength=count($wrong);
          for($x=0;$x<$arrlength;$x++)
          {
            if ($wrong[$x]===$prob_code)
            {
              $flag=true;
              break;
            }
          }
        }
        if($flag===false)
        {
          $wa=$wa.$prob_code.";";
          // echo $prob_code;
          // echo $wa;
        }
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if($wrong[$x]==="")
          continue;
          $wa=$wa.$wrong[$x].';';
        }
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if($correct[$x]==="")
          continue;
          $ca=$ca.$correct[$x].';';
        }
        break;
        case '3':
        echo "Run Time Error";
        $query="select wrong_submission from problems_db where prob_id = '".$prob_code."';";
        $result=$conn->query($query);
        while($row = $result->fetch_assoc())
        {
          $wac=(string)((int)$row["wrong_submission"]+1);
          $query="UPDATE problems_db set wrong_submission='".$wac."'where prob_id = '".$prob_code."';";
          if ( $conn->query($query)=== TRUE) {
          } else {
            echo "Error updating record: " . $conn->error;
          }
        }
        $flag=false;
        $ca="";
        $wa="";
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($correct[$x]===$prob_code)
          {
            $flag=true;
            break;
          }
        }
        if($flag===false)
        {
          $arrlength=count($wrong);
          for($x=0;$x<$arrlength;$x++)
          {
            $flag=true;
          }
        }
        if($flag===false)
        {
          $wa=$wa.$prob_code.";";
        }
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if($wrong[$x]==="")
          continue;
          $wa=$wa.$wrong[$x].';';
        }
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if($correct[$x]==="")
          continue;
          $ca=$ca.$correct[$x].';';
        }
        break;
        case '4':
        echo "time Limit Exceeded";
        $query="select wrong_submission from problems_db where prob_id = '".$prob_code."';";
        $result=$conn->query($query);
        while($row = $result->fetch_assoc())
        {
          $wac=(string)((int)$row["wrong_submission"]+1);
          $query="UPDATE problems_db set wrong_submission='".$wac."'where prob_id = '".$prob_code."';";
          if ( $conn->query($query)=== TRUE) {
          } else {
            echo "Error updating record: " . $conn->error;
          }
        }
        $flag=false;
        $ca="";
        $wa="";
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if ($correct[$x]===$prob_code)
          {
            $flag=true;
            break;
          }
        }
        if($flag===false)
        {
          $arrlength=count($wrong);
          for($x=0;$x<$arrlength;$x++)
          {
            $flag=true;
          }
        }
        if($flag===false)
        {
          $wa=$wa.$prob_code.";";
        }
        $arrlength=count($wrong);
        for($x=0;$x<$arrlength;$x++)
        {
          if($wrong[$x]==="")
          continue;
          $wa=$wa.$wrong[$x].';';
        }
        $arrlength=count($correct);
        for($x=0;$x<$arrlength;$x++)
        {
          if($correct[$x]==="")
          continue;
          $ca=$ca.$correct[$x].';';
        }
        break;
        default:
        // code...
        // echo "default Executed";
        break;
      }
      if($ca==="")
      {
        $ca=";";
      }
      if($wa==="")
      {
        $wa=";";
      }
      $query="UPDATE node set correct_answer = '".$ca."' where username = '".$_SESSION["username"]."';";
      if ($conn->query($query) === TRUE) {
      } else {
        echo "Error updating record: " . $conn->error;
      }
      $query="UPDATE node set wrong_answer = '".$wa."' where username = '".$_SESSION["username"]."';";
      if ($conn->query($query) === TRUE) {
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
    else {
      echo "Error in file uploading";
    }
  }else{
    print_r($errors);
  }
  $conn->close();
}
?>
