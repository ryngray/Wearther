<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	  <title>Wearther or Not </title>
	  <meta charset="UTF-8">
	  <link href='https://fonts.googleapis.com/css?family=Montserrat|Merriweather' rel='stylesheet' type='text/css'>
	<style>
		body {
			background: url(http://vectorandpsd.com/vectorandpsd/background/blue-poly-background.jpg);
			background-size: 100% 100%;
			background-repeat: no-repeat;
			border: 2px solid black;
			font-family: 'Merriweather', serif;
		}
		h1, h2, h3, h4 {
			font-family: 'Montserrat', sans-serif;
		}
		h1 {
			text-align: center;
			font-size: 50px;
			color: #fff;
			text-transform: uppercase;
			letter-spacing: 4px;
		}
		#day {
			font-size: 30px;
			color: #4d3319;
			text-align: center;
		}
		.button {
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 16px 32px;
			text-align: center;
			text-decoration: none;
			display: block;
			font-size: 16px;
			margin: 10px auto 50px;
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			cursor: pointer;
		}
		.button2 {
			background-color: #e6ccb3; 
			color: #333; 
			border-radius: 5px;
		}
		.button2:hover {
			background-color: #d2a479;
		}
		#temp {
			text-align: center;
		}
		#temperature {
			text-align: center;
			font-size: 80px;
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
			width: 90%;
			max-width: 700px;
			margin: 0 auto;
		}
		.vidcover {
		  background: #000;
		  opacity: 0;
		  display: block;
		  width: 100%;
		  height: 100%;
		  position: fixed;
		  top: 0;
		  left: 0;
		  z-index: -1;
		  -webkit-transition: opacity 800ms ease 0.2s;
		  -moz-transition: opacity 800ms ease 0.2s;
		  -ms-transition: opacity 800ms ease 0.2s;
		  transition: opacity 800ms ease 0.2s;
		}

		.fullvid {
		  width: 1280px;
		  height: 720px;
		  position: fixed;
		  bottom: 50%;
		  left: 50%;
		  z-index: -2;
		  -webkit-transform: translate(-50%, 50%);
		  -moz-transform: translate(-50%, 50%);
		  -ms-transform: translate(-50%, 50%);
		  transform: translate(-50%, 50%);
		  -webkit-transition: all 400ms ease-out 400ms;
		  -moz-transition: all 400ms ease-out 400ms;
		  -ms-transition: all 400ms ease-out 400ms;
		  transition: all 400ms ease-out 400ms;
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
	<script>
		$(document).ready(function() {
  $('body')
    .prepend('<div class="vidcover"></div>')
    .hover (
  		function() {
  			$('.vidcover').css({'opacity':'0'})
 	 	},
 	 	function() {
 	 		$('.vidcover').css({'opacity':'0'})
 	 	}
  	);
  
	$(window).resize( function(){
		var theWidth = $(window).width();
		var theHeight = $(window).height();
		var newWidth = (theHeight*1.77777778);
		var newHeight = (theWidth/1.77777778);

		if ( (theWidth > 1280) && (newHeight > theHeight )) {
			$('.fullvid').css({'width':theWidth, 'height':newHeight});
		}

		if ( (theHeight > 720) && (newWidth > theWidth )) {
			$('.fullvid').css({'height':theHeight, 'width':newWidth});
		}

		$('.vidcover').css({'height':theHeight, 'width':theWidth});
	}).resize();
});
	</script>
	</head>
	
	<body>
		<header>
			<iframe class="fullvid" width="1280" height="720" src="https://www.youtube.com/embed/sHgOn5s-MCw?hd=1&amp;iv_load_policy=3&amp;loop=1&amp;rel=0&amp;showinfo=0&amp;autoplay=1&amp;controls=0" frameborder="0" allowfullscreen></iframe>
			<h1> Wearther or Not </h1>
		</header>
		<form method="post" action="index.php">
				<input type="submit" class="button button2" value="Change Location">
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
		?> 
		<section>
		<?php
		
			for($r=0; $r<10; $r++){
				if($r == 0){
				
					echo '<div type="text" id= "day" ><h3>'.$endArray[$m][$r]."</div></h3><br>";
			
				}
				if($r == 1){
					echo '<div type="text" id="temp"><b><i>'.$tempId[$m], ": ".'</b></div></i>';
					echo '<div type="text" id = "temperature">'.$endArray[$m][$r]."&deg;</div><br>";
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
				echo '<p><img src="'.$endArray[$m][$r].'" alt="unable to load image" style="width:400px; height: auto; margin:0 auto; display:block";  /></p><br>';
			}
			if($r == 4){
				echo '<br><b><i><div type="text" id = "text">'.$endArray[$m][$r]."</div></b></i><br>";
			}
		//echo $endArray[$m][$r]."<br>";
		echo " ";
		}
		?> 
		</section>
		<?php
		echo " "."<br>";
	}
	?>
	</body>
</html>