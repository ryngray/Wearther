<?php //session_start();
$LatvsLon = array(null, null);
setcookie("test_cookie", serialize($LatvsLon), time()+3600, '/');
$counter = 0;
setcookie("count", $counter, time()+3600, '/');
$counter = $_COOKIE['count'];
?>


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
		#button {
			position: fixed;
			top: 60%;
			left: 45%;
		}
	</style>
	</header>

<body>
	<h1><b><i>To Wear or Not to Wear, that is the Question!</b></i></h1>
	<hr>
	<div>
		<?php
		/*if($_SESSION["tester"]!=1){
		$_SESSION["tester"]=1;
		$_SESSION["coatArray"]=null;-->*/
		//$counter=0;
		//echo "ARRAY".$_SESSION["coatArray"][0]." COUNTER: ".$_SESSION["counter"];
?>
 <form method="post" action="input.php" name="weather">

     Latitude: <input type="text" name="lat" size = "12"/><br>
     Longitude: <input type = "text" name = "lon" size = "10"/><br>
		 <input type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >

 </form>
 </div>
 <!--<form method="post" action="inputClothes.php">
    <button formaction="inputClothes.php" type = "submit"  style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >
			Enter jackets:
		</button>
 </form> -->

</body>


</html>