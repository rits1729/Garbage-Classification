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
	<script>
		<?php 
			if(isset($_GET["alert"])){
				if($_GET["alert"]==0){
		?>
				alert("Messege is sent to the owner of the dustbin");
		<?php
				} else {
		?>
				alert("Sorry some problem occurred");
		<?php
				}
			}
		?>
	</script>
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
			<img  id="cover_pic" src="images/poster3.jpg">
			<div id="boxOverImage">
			<ul>
				<form action="result.php" method="post" enctype="multipart/form-data">
				<li><b>Garbage Image</b></li>
				<li>
					<input type="file" name="fileToUpload" id="fileToUpload">
				</li>
				<li></li>
				<li><b>Throw</b></li>
				<li><input type="submit" value="Throw" name="submit"></li>
				</form>
			</ul>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>	
      

	
 </div> 
</body>
</html>
 