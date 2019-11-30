<?php
		$val=$_GET['val'];
		$conn=mysqli_connect("localhost","root","");
		mysqli_select_db($conn,"garbage");
		$sql="update container set current_weight='0' where container_name='$val'";
		$result=mysqli_query($conn,$sql);
		echo "<script type=text/javascript>alert('dustbin cleaned');</script>";
		mysqli_close($conn);
	?>
	<a href="admin_index.php">Go back to the page</a>