<?php session_start(); 
$LatvsLon=array(null, null);
setcookie("test_cookie", serialize($LatvsLon), time()+3600, '/');
$counter = 0;
setcookie("counter", $counter, time()+3600, '/');
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
		htmlspecialchars($_SERVER["PHP_SELF"]);
		//$_SESSION["counter"]=0;
		//echo "COUNTER: ".$_SESSION["counter"];
		//if($_SESSION["tester"]!=1){
			$_SESSION["tester"]=1;
			$_SESSION["coatArray"]=null;
			//$_SESSION["counter"]=0;
		//}
		if($_SERVER["PHP_SELF"]){
			
		$_SESSION["lat"]=null;
		$_SESSION["lon"]=null;
		  if(empty($_POST['lat'])){
		    echo "Please enter a latitude.".'<br>';
		  }
		  else{
		    $_SESSION["lat"] = $_POST['lat'];
		  }
		  if(empty($_POST['lon'])){
		    echo "Please enter a longitude.".'<br>';
		  }
		  else{
				$_SESSION["lon"]= $_POST['lon'];
		  }
			if($_SESSION["lat"]!=null&&$_SESSION["lon"]!=null){
				header('Location:http://localhost/my_site/wearther/input.php');
				die;
			}
		  function test_input($data) {
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}
	}
		//echo "ARRAY".$_SESSION["coatArray"][0]." COUNTER: ".$_SESSION["counter"];
?>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="weather">

     Latitude: <input type="text" name="lat" size = "12"/><br>
     Longitude: <input type = "text" name = "lon" size = "10"/><br>
		 <input type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >

 </form>
 </div>
<!-- <form method="post" action="input.php">

    <button formaction="inputClothes.php" type = "submit"  style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >
			Enter jackets:
		</button>
 </form>-->

</body>


</html>
