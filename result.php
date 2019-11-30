<?php

require_once('db.php');

      class Prediction extends Database{

        function __construct(){
          parent::__construct();
        }

        public function setHist($img_path,$probability,$container_id){
          $this->pdo->beginTransaction();
          try {
            $sql = "INSERT INTO `garbage`.`history` (garbage_image,probability,container_id) VALUES (:garbage_image, :probability, :container_id)";
            $stmt = $this->pdo->prepare($sql);
            $exe = [
              'garbage_image' => $img_path,
              'probability' => $probability,
              'container_id' => $container_id
            ];
            $execution = $stmt->execute($exe);
            $this->pdo->commit();
            return true;
          } catch(PDOException $e) {
            $this->pdo->rollBack();
            return $e->getMessage();
          }
        }
        public function getOwnerNumber($container_id){
          $sql = "SELECT * FROM `garbage`.`owner` WHERE container_id = :container_id";
          $stmt = $this->pdo->prepare($sql);
          $exe = [
            'container_id' => $container_id
          ];
          $stmt->execute($exe);
          while($row = $stmt->fetch()){
            return $row->phonenumber;
          }
        }
        public function setContainer($img_path,$probability,$container_id){
          try {
            $weight = 0;
            switch ($container_id) {
              case 0:
                  $weight = rand(2,3);
                  break;
              case 1:
                  $weight = rand(3,4);
                  break;
              case 2:
                  $weight = rand(4,5);
                  break;
              case 3:
                  $weight = rand(0.5,1);
                  break;
              case 4:
                  $weight = rand(1,2);
                  break;
              case 5:
                  $weight = rand(1,5);
                  break;
            }
            $sql = "SELECT * FROM `garbage`.`container` WHERE container_id = :container_id";
            $stmt = $this->pdo->prepare($sql);
            $exe = [
              'container_id' => $container_id
            ];
            $stmt->execute($exe);
            while($row = $stmt->fetch()){
              $total_weight = $row->current_weight + $weight;
              if($total_weight > $row->capacity){
                return false;
              } else {
                $sql = "UPDATE `garbage`.`container` SET current_weight = :current_weight WHERE container_id = :container_id";
                $stmt = $this->pdo->prepare($sql);
                $exe = [
                  'current_weight' => $total_weight,
                  'container_id' => $container_id
                ];
                $execution = $stmt->execute($exe);
              }
            }
            return true;
          } catch(PDOException $e) {
            return $e->getMessage();
          }
        }
      }


$target_dir = "./";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$error = "";
if(basename($_FILES["fileToUpload"]["name"])==""){
  echo "Sorry!! please choose a image file";
  echo "<br><a href=\"index.php\">Try Again</a>";
  die();
}
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $error = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
    $error = $imageFileType."!! Sorry, only JPG files are allowed.";
    $uploadOk = 0;
}

$name = uniqid(rand(),true);
$target_file = "images/".$name.".".$imageFileType;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk!=0 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  #Ok
} else {
  $error = "Sorry, there was an error uploading your file.";
}
?>


<?php

function PsExecute($command, $timeout = 60, $sleep = 5) {
  // First, execute the process, get the process ID
  $pid = PsExec($command);
  if( $pid === false )
    return false;

  $cur = 0;
  // Second, loop for $timeout seconds checking if process is running
  while( $cur < $timeout ) {
    usleep($sleep*1000000);
    $cur += $sleep;
    // If process is no longer running, return true;-

    if( !PsExists($pid) )
      return true; // Process must have exited, success!
  }

  // If process is still running after timeout, kill the process and return false
  PsKill($pid);
  return false;
}

  function PsExec($commandJob) {
      $command = $commandJob.' > output.txt 2>&1 & echo $!';
      exec($command ,$op);
      $pid = (int)$op[0];

      if($pid!="") return $pid;

      return false;
  }

  function PsExists($pid) {

      exec("ps ax | grep $pid 2>&1", $output);

      while( list(,$row) = each($output) ) {

              $row_array = explode(" ", $row);
              $check_pid = $row_array[0];

              if($pid == $check_pid) {
                      return true;
              }

      }
      #echo "Does not exist";
      return false;
  }

  function PsKill($pid) {
      exec("kill -9 $pid", $output);
      #echo "Killed";
  }


function getOutput($target_file,$time_limit,$sleep){
	$compiler="/home/amit/anaconda3/bin/python3";
	$filename_code="/opt/lampp/htdocs/GarbageRecognition/test.py";
	$filename_error="error.txt";
	$command=$compiler." ".$filename_code;
	$command_error=$command." 2>".$filename_error;

  $input=fopen("input.txt","w+");
  fwrite($input,$target_file);
  fclose($input);

	$error_cmd="";

	if(trim($error_cmd)==""){
		if(PsExecute($command." < input.txt",$time_limit,$sleep)){
      $output = file_get_contents("output.txt");
      $output = explode("> ", $output);

      $db = new Prediction; 
      $cont = $db->setContainer($target_file,$output[1],$output[2]);
      if($cont==false){
        echo "Dustbin is full";
        $phonenumber = $db->getOwnerNumber($output[2]);
        echo "<a href=\"message.php?number=".$phonenumber."\">Send message to owner</a>";
      } else {
        $hist = $db->setHist($target_file,$output[1],$output[2]);
        echo "Successfully garbage thrown!!!";
        if($hist==false){
          echo "hist error";
        }
      }
    } else {
      $output = "TIME_LIMIT_EXCEED";
    }
		return $output;
	} else {
		return "Error in the pyhton script ".$error_cmd;
	}
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Waste Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="header.css">
  <link rel="stylesheet" type="text/css" href="home.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div id="header"class="list-inline container-fluid">
           <ul>
      <li  class="list-inline-item">
          <img id="i1"  src="images/waste_i1.jpg" >
      </li>
      <li  class="list-inline-item">
          <p id="h">Waste</p>
            <p id="l">Management System</p>
      </li>
      
      
             <li class="list-inline-item"> 
        <p id="line1">"Use it up, Wear it out,</p>
                <p id="line2">Make it do, Or do without"</p>
      </li>
      <li  class="list-inline-item">
                <img id="i2" src="images/waste_i2.jpeg" >
      </li>
    </ul>
            
    </div>

<div >
  <div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10"id="box">
      <img height="300vh" width="300vh" src="<?php echo  $target_file; ?>">
      <?php
        if($error != ""){
          echo $error;
        } else {
          $opt = getOutput($target_file,200,10);
          $classes = array('cardboard','glass','metal', 'paper','plastic', 'trash');
          echo "<br> Predicted garbage => ".$classes[(int)$opt[2]];
          echo "<br> probability => ".$opt[1];
        }
      ?>
      <br>
      <div id="boxOverImage">
      <ul>
        <li></li>
        <li><b>Throw another garbage</b></li>
        <li><a href="index.php"><button type="button" >Next Garbage</button></a></li>
        <li></li>
        
        
      </ul>
      </div>
    </div>
    <div class="col-md-1">
    </div>
  </div>  
      

  
 </div> 
</body>
</html>

