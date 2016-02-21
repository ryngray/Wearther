<html>
	<header>
	  <title>Wearther or Not </title>
	  <meta charset="UTF-8">
	<style>
		body {
			background: url(http://vectorandpsd.com/vectorandpsd/background/blue-poly-background.jpg);
			background-size: 100% 100%;
			background-repeat: no-repeat;
			border: 2px solid black;
		}
		#day {
			font-size: 200%;
			text-decoration: underline;
			text-align: center;
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
			color: 008CBA; 
			border: 2px solid #008CBA;
		}
		.button2:hover {
			background-color: #008CBA;
			color: white;
		}
		#temp {
			text-align: center;
		}
		hr {
			display: block;
			height: 2px;
			border: 0;
			border-top: 2px solid black;
			margin: 1em 0;
			padding: 0; 
		}
		#text {
			text-align: center;
		}
	</style>
	</header>
	
	<body>
		<form method="post" action="index.php">
				<input type="submit" class="button button2" value="Home">
		  </form>
	<?php
		htmlspecialchars($_SERVER["PHP_SELF"]);
		$lat = $lon = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$lat = test_input($_POST['lat']);
			$lon = test_input($_POST['lon']);
			//echo $lat;
			//echo $lon;
		}

		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//var_dump($_POST);

		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		//echo $lat;
		//echo $lon;

		$url="http://forecast.weather.gov/MapClick.php?lat=".$lat."&lon=".$lon."&FcstType=json";
		//echo "URL: ".$url."<br>";
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,$url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
		$query = curl_exec($curl_handle);
		curl_close($curl_handle);
		//echo $query;
		$Jweather = json_decode($query);
		$startPeriodArray = $Jweather->time->startPeriodName;
		$temp = $Jweather->data->temperature;
		$weather = $Jweather->data->weather;
		$icon = $Jweather->data->iconLink;
		$size = sizeof($startPeriodArray);
		$text = $Jweather->data->text;
		$tempId = $Jweather->time->tempLabel;
		$endArray = array(null, null, null, null, null, null, null);
		$newArray;
		$counter=0;

		for($i = 0; $i < 12; $i++){
			$newArray = array($startPeriodArray[$i], $temp[$i], $weather[$i], $icon[$i], $text[$i]);
			$endArray[$i] = $newArray;
		}
		for( $m=0; $m<8; $m++){
			for($r=0; $r<10; $r++){
				if($r == 0){
					echo '<div type="text" id= "day" ><b>'.$endArray[$m][$r]."</div></b><br>";
			
				}
				if($r == 1){
					echo '<div type="text" id="temp"><b><i>'.$tempId[$m], ": ".'</b></i>';
					echo '<id = "temperature"><i>'.$endArray[$m][$r]."</div></i><br>";
				if($endArray[$m][$r]<30){
					echo "<b><center>Wear a heavy coat."."</center></b><br>";
				}
				elseif($endArray[$m][$r]<50){
					echo "<b><center>Wear a medium jacket."."</center></b><br>";
				}
				elseif($endArray[$m][$r]<60){
					echo "<b><center>Wear a light jacket."."</b></center><br>";
				}
				else{
					echo "<b><center>You do not need to wear a jacket today."."</center></b><br>";
				}
			}
			if($r == 2){
				echo '<font size="2"><i><center><id = "weather">'.$endArray[$m][$r]."</i></font></center>";
			}
			if($r == 3){
				echo '<p><img src="'.$endArray[$m][$r].'" alt="unable to load image" width="50%" height="50%" align="center" /></p><br>';
			}
			if($r == 4){
				echo '<br><b><i><div type="text" id = "text">'.$endArray[$m][$r]."</div></b></i><br>";
			}
		//echo $endArray[$m][$r]."<br>";
		echo " ";
		}
		echo " "."<br><hr>";
	}
	?>
	</body>
</html>