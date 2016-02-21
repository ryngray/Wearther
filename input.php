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
    </style>
  	</header>
  	<body>

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

for($i = 0; $i < 14; $i++){
  $newArray = array($startPeriodArray[$i], $temp[$i], $weather[$i], $icon[$i], $text[$i]);
  $endArray[$i] = $newArray;
}
for( $m=0; $m<8; $m++){
 for($r=0; $r<10; $r++){
   if($r == 0){
     echo '<id = "day">'.$endArray[$m][$r]."<br>";
   }
   if($r == 1){
     echo $tempId[$m], ": ";
     echo '<id = "temperature">'.$endArray[$m][$r]."<br>";
     if($endArray[$m][$r]<30){
       echo "wear a heavy coat"."<br>";
     }
     elseif($endArray[$m][$r]<50){
       echo "wear a jacket"."<br>";
     }
     elseif($endArray[$m][$r]<60){
       echo "wear a light jacket"."<br>";
     }
     else{
       echo "It's pretty warm"."<br>";
     }
   }
   if($r == 2){
     echo '<id = "weather">'.$endArray[$m][$r]."<br>";
   }
   if($r == 3){
     echo '<img src="'.$endArray[$m][$r].'" alt="unable to load image" />';
   }
   if($r == 4){
     echo '<id = "text">'.$endArray[$m][$r]."</div><br>";
   }
   //echo $endArray[$m][$r]."<br>";
   echo " ";
 }
 echo "****"."<br>";
}

?>
</body>
</html>
