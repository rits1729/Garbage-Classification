<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Waste Management</title>
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
		<a href="hist.php" type="button" >HISTORY </a>
		</div>
		<div class="col-md-11"id="box">
		
			<div ><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d1.jpg"><div >CARDBOARD <div id="msg1" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="cardboard" name="val"><button type="submit">RECYCLE</button></form></div><br>
			<div ><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d2.jpg"><div>GLASS <div id="msg2" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="glass" name="val"><button type="submit">RECYCLE</button></form></div><br>
			<div><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d3.jpg"><div>METAL <div id="msg3" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="metal" name="val"><button type="submit">RECYCLE</button></form></div><br><br>
			
			<div><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d4.jpg"><div>PLASTIC <div id="msg4" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="plastic" name="val"><button type="submit">RECYCLE</button></form></div><br><br>
			<div><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d5.jpeg"><div>THRASH <div id="msg5" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="thrash" name="val"><button type="submit">RECYCLE</button></form></div><br><br>
			<div><img style="height:40vh;width:40vh;" id="dust_pic" src="images/d1.jpg"><div>PAPER <div id="msg6" class="text-info"></div>
			<form action="recycle.php"><input type="hidden" value="paper" name="val"><button type="submit">RECYCLE</button></form></div><br><br>
		</div>
		<div class="col-md-1">
		</div>
	</div>	
      

	
 </div> 
 	<?php
		$conn=mysqli_connect("localhost","root","");
		mysqli_select_db($conn,"garbage");
		$sql="select * from container where container_name='cardboard'";
		$sql1="select * from container where container_name='glass'";
		$sql2="select * from container where container_name='metal'";
		$sql3="select * from container where container_name='plastic'";
		$sql4="select * from container where container_name='thrash'";
		$sql5="select * from container where container_name='paper'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg1').innerHTML=".$row[6]."</script>";	
		$result=mysqli_query($conn,$sql1);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg2').innerHTML=".$row[6]."</script>";	
		$result=mysqli_query($conn,$sql2);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg3').innerHTML=".$row[6]."</script>";	
		$result=mysqli_query($conn,$sql3);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg4').innerHTML=".$row[6]."</script>";	
		$result=mysqli_query($conn,$sql4);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg5').innerHTML=".$row[6]."</script>";	
		$result=mysqli_query($conn,$sql5);
		$row=mysqli_fetch_array($result);
		echo "<script type='text/javascript'>document.getElementById('msg6').innerHTML=".$row[6]."</script>";	
		mysqli_close($conn);
	?>
</body>
</html>
 