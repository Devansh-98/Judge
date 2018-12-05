<?php
if(isset($_FILES['srcCode'])){
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
      exec($query,$o,$r);
      switch ($r) {
        case '0':
          echo "Correct Answer";
          break;
        case '1':
          echo "Wrong Answer";
          break;
        case '2':
          echo "compile time error";
          break;
        case '3':
          echo "Run Time Error";
          break;
        case '4':
          echo "time Limit Exceeded";
          break;
        default:
          // code...
          // echo "default Executed";
          break;
      }
    }
    else {
      echo "Error in file uploading";
    }
  }else{
    print_r($errors);
  }
}
?>
