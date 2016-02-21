<?php session_start(); ?>
<!DOCTYPE html>
<html>
<header>
		<title>Wearther or Not </title>
		<meta charset="UTF-8">
	<style>
		body {
			background: url(http://vectorandpsd.com/vectorandpsd/background/blue-poly-background.jpg);
			background-size: cover 100%;
			background-repeat: no-repeat;
			border: 2px solid black;
			}
		h1 {
			text-align: center;
			letter-spacing: 5px;
			text-shadow: 3px 3px  #8c8c8c;
			text-transform: capitalize;
			font: 30px helvetica, sans-serif;
			top: 50%;
			left: 50%;
		}
		h2 {
			position: absolute;
			top: 50%;
			left: 50%;
		}
		div {
			position: fixed;
			top: 40%;
			left: 35%;
		}
		.button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.button2 {
		background-color: #e6f5ff; 
		color: #008CBA; 
		border: 2px solid #008CBA;
	}

	.button2:hover {
		background-color: #008CBA;
		color: white;
	}
	#button {
		position: static;
		top: 30%;
		left: 45%;
		border: 2px solid black;
	}
	#button2 {
			position: fixed;
			top: 60%;
			left: 45%;
		}
	section {
		background: #fff;
		padding: 30px 20px;
		width: 90%;
		max-width: 600px;
		margin: 0 auto;
		border-top: 15px solid #4d3319;
	}

	</style>
	</header>

<body>
	<h1><b><i>To Wear or Not to Wear, that is the Question!</b></i></h1>
	<div>
		<?php
		htmlspecialchars($_SERVER["PHP_SELF"]);
		if($_SERVER["PHP_SELF"]){
		if($_SESSION["tester"]!=1){
			$_SESSION["tester"]=1;
			$_SESSION["coatArray"]=null;
			$_SESSION["counter"]=0;
		}
		$_SESSION["lat"]=null;
		$_SESSION["lon"]=null;
		  if(empty($_POST['lat'])){
		    echo '<i><p align="auto"><font size="2">'."Please enter a latitude.".'</p></font></i><br>';
		  }
		  else{
		    $_SESSION["lat"] = $_POST['lat'];
		  }
		  if(empty($_POST['lon'])){
		    echo '<i><p align="auto"><font size="2">'."Please enter a longitude.".'</p></i></font><br><br>';
		  }
		  else{
				$_SESSION["lon"]= $_POST['lon'];
		  }
			if($_SESSION["lat"]!=null&&$_SESSION["lon"]!=null){
				header('Location: http://localhost/my_site/input.php');
				die;
			}
		  function test_input($data) {
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}
	}
	?>
	 <form method="post" action="input.php">
		<b>Latitude: <input type="text" name="lat" size = "12"/></b><br><br>
		<b>Longitude: <b><input type = "text" name = "lon" size = "10"/></b><br><br>
			 <input type="submit" class="button button2" value="Submit">
 </form>
 </div>
</body>
</html>