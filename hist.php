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

	
 </div> 
<div id="image_cont">
	<div class="row">
	<div class="col-sm-1">
	</div>
    <div class="col-sm-10 Head_nn" id="Head_body">
		<h1 class="text-center">WASTE MANAGEMENT</h1>
		<table class="table table-hover table-info table-responsive">
			<thead>
				<tr>
					<th>HIST ID</th>
					<th>GARBAGE IMAGE</th>
					<th>PROBABILITY</th>
					<th>CONTAINER ID</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					
					$conn=mysqli_connect("localhost","root","");
					mysqli_select_db($conn,"garbage");
					$sql="select * from history";
					$result=mysqli_query($conn,$sql);
					
					while($row=mysqli_fetch_array($result))
					{
						$r0=$row[0];
						$r1=$row[1];
						$r2=$row[2];
						$r3=$row[3];		 
						
								
							echo "<tr>"	;		
							echo"<td>".$r0."</td>";
							echo"<td><img src='".$r1."' style='height:5vh;width:5vh'</td>";
							echo"<td>".$r2."</td>";
							echo"<td>".$r3."</td>";
							echo "</tr>";
						
					}
					mysqli_close($conn);
					?>	
			</tbody>
		</table>
		
	</div>
</div>
</div>
<a href="admin_index.php" type="button">Go back to the page</a>
</body>
<html>

