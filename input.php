<?php session_start(); ?>

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
    #day{
    }
    </style>
  	</header>
  	<body>
      <form method="post" action="index.php">
        Enter a new latitude and longitude:
     		 <input type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >

      </form>
<?php
/*ignore this, for the later file*/
//echo "ARRAY ".$_SESSION["coatArray"][0]." COUNTER: ".$_SESSION["counter"];
$lessthanzero=null;
$zerotoforty=null;
$fortytosixty=null;
$sixtytoeighty=null;
$eightyplus=null;
for($nn=0; $nn<$_SESSION["counter"]; $nn++){
  $arr=$_SESSION["coatArray"][$nn];
  $tr=$arr[1];
  //echo "Temp range: ".$tr.'<br>';
  if($tr=="<0"){
    echo "Less than zero".'<br>';
    $next=count($lessthanzero);
    $lessthanzero[$next]=$arr[0];
  }if($tr=="0to40"){
    echo "0 to 40".'<br>';
    $next=count($zerotoforty);
    $zerotoforty[$next]=$arr[0];
  }if($tr=="40to60"){
    echo "40 to 60".'<br>';
    $next=count($fortytosixy);
    $fortytosixy[$next]=$arr[0];
  }
  if($tr=="60to80"){
    echo "60 to 80".'<br>';
    $next=count($sixtytoeighty);
    $sixtytoeighty[$next]=$arr[0];
  }if($tr=="80+"){
    echo "80 +".'<br>';
    $next=count($eightyplus);
    $eightyplus[$next]=$arr[0];
  }
}
/*htmlspecialchars($_SERVER["PHP_SELF"]);
$lat = $lon = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$lat = test_input($_POST['lat']);
	$lon = test_input($_POST['lon']);
	//echo $lat;
	//echo $lon;
}*/
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
//var_dump($_POST);
$lat = $_SESSION["lat"];
$lon = $_SESSION['lon'];
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
     echo '<id = "day"><b>'.$endArray[$m][$r]."</b><br>";
   }
   if($r == 1){
     echo $tempId[$m], ": ";
     echo '<id = "temperature">'.$endArray[$m][$r]."<br>";
     $currTemp=$endArray[$m][$r];
     if($currTemp<=0){
       echo "Wear a heavy coat"."<br>";
	   if($lessthanzero!=null){
       echo "****".'<br>';
       echo "Your appropriate coats:".'<br>';
       for($aa=0; $aa<count($lessthanzero); $aa++){
         echo $lessthanzero[$aa];
         if($aa!=count($lessthanzero)-1){
           echo ", ";
         }
         else {
           echo ""."<br>";
         }
       }
	   }
     }
     elseif($currTemp>0&&$currTemp<=40){
       echo "wear a jacket"."<br>";
	   if($zerotoforty!=null){
       echo "****".'<br>';
       echo "Your appropriate coats:".'<br>';
       for($ab=0; $ab<count($zerotoforty); $ab++){
         echo $zerotoforty[$ab];
         if($ab!=count($zerotoforty)-1){
           echo ", ";
         }
         else {
           echo ""."<br>";
         }
       }
	   }
     }
     elseif($currTemp>40&&$currTemp<=60){
       echo "wear a light jacket"."<br>";
	   if($fortytosixty!=null){
       echo "****".'<br>';
       echo "Your appropriate coats:".'<br>';
       for($ac=0; $ac<count($fortytosixy); $ac++){
         echo $fortytosixy[$ac];
         if($ac!=count($fortytosixty)-1){
           echo ", ";
         }
         else {
           echo ""."<br>";
         }
       }
	   }
     }
     elseif($currTemp>60&&$currTemp<=80){
       echo "It's pretty warm"."<br>";
	   if($sixtytoeighty!=null){
       echo "****".'<br>';
       echo "Your appropriate coats:".'<br>';
       for($ad=0; $ad<count($sixtytoeighty); $ad++){
         echo $sixtytoeighty[$ad];
         if($ad!=count($lessthanzero)-1){
           echo ", ";
         }
         else {
           echo ""."<br>";
         }
       }
	   }
     }
     else{
       echo "It's hot out."."<br>";
	   if($eightyplus!=null){
       echo "****".'<br>';
       echo "Your appropriate coats:".'<br>';
       for($ae=0; $ae<count($eightyplus); $ae++){
         echo $eightyplus[$ae];
         if($ae!=count($eightyplus)-1){
           echo ", ";
         }
         else {
           echo ""."<br>";
         }
       }
	   }
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

<form method="post" action="inputClothes.php">
  Enter jackets:
   <input type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >

</form>
</body>
</html>
