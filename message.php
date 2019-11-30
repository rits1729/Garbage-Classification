<?php
require('textlocal.class.php');

$textlocal = new Textlocal('flase', 'false','2WeOVSKtD+0-9bOHZPfqbMAvKwiBtGncn0oivcvd6L');

if(isset($_GET["number"])){
	$phone=$_GET["number"];
} else {
	header("location:index.php?alert=1");
}
$numbers = array($phone);
$sender = 'TXTLCL';
$message = 'Clean the dustbin';

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "MSG SENT!!";
} catch (Exception $e) {
    header("location:index.php?alert=1");
}

header("location:index.php?alert=0");
mysqli_close($conn);
?>
