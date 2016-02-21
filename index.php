<!DOCTYPE html>
<html>
<header>
		<title>Wearther or Not </title>
		<meta charset="UTF-8">
	<style>
		body {
			background: url(http://vectorandpsd.com/vectorandpsd/background/blue-poly-background.jpg);
			background-size: 100% 100%;
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
 <form method="post" action="input.php">

     Latitude: <input type="text" name="lat" size = "12"/><br>
     Longitude: <input type = "text" name = "lon" size = "10"/><br>
		 <input type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >

 </form>
 </div>
</body>


</html>
