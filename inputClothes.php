<?php session_start();
$counter = $_COOKIE['counter'];
 ?>

<html>
<body>
  <?php /*$GLOBALS['coatCounter']=0;*/
    //session_start();
    //$coatArray=null;
    //$coatArray=array(array("Test1", "Test2"), array("Test3", "Test4"));
    //$_SESSION["coatArray"];
    //$_SESSION["counter"];
    //echo "Beginning of file array: <br>";
    //var_dump($_SESSION["coatArray"]);
    //echo $_SESSION["counter"];
    //echo "ARRAY".$_SESSION["coatArray"][0]." COUNTER: ".$_SESSION["counter"];
    print_r($_SESSION);
    //$_SESSION["TEST"]="TESTTESTTES";
   ?>
  <?php
  echo $counter;
  $tempString=null;
  $descrip=null;
  $coatError = null;
  $descripError = null;
  if(empty($_POST['temp'])){
    $coatError = "Please select a range of temperatures.";
    $tempString=null;
  }
  else{
    $tempString = $_POST['temp'];
  }
  if(empty($_POST['descrip'])){
    $descripError = "Please enter a description of the coat";
    $descrip=null;
  }
  else{
    $descrip = $_POST['descrip'];
    //echo "DESCRIPION: ";
    //echo $descrip;
    //$i++;
  }
  function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
//unset($_POST);
//echo "Description: ".$descrip;
   ?>
   <div id="instruct"> Please select a range of temperatures. </div>
<form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="radio" name="temp" value="<-10"> less than -10 degrees F<br>
  <input type="radio" name="temp" value="0to40"> 0->40 degrees F<br>
  <input type="radio" name="temp" value="40to60"> 40->60 degrees F<br>
  <input type="radio" name="temp" value="60to80"> 60->80 degrees F<br>
  <input type="radio" name="temp" value="80+"> 80+ degrees F <br>
  <span class="error">*<?php echo $coatError;?></span><br><br>
  <input type="text" name = "descrip">
  <span class="error">*<?php echo $descripError;?></span>
  <input type = "submit" name = "submit" value = "Enter" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >
</form>

<?php
  //echo "Test: ".$_SESSION["TEST"];
  //$i=$GLOBALS['coatCounter']
//  $_SESSION["counter"]=count($_SESSION["coatArray"]);
  $arraySize=$counter;
  if($descrip!=null&&$tempString!=null){
    //echo "Size: ".$arraySize.'<br>';
    echo "You have entered a new coat:"."<br>";
    echo "Decription: ", $descrip.'<br>';
    echo "Temperature Range: ", $tempString."<br>";
    $newArray = array($descrip, $tempString);
    //echo "New Array: Descrip= ".$newArray[0]."<br>";
    //echo "Temp: ".$newArray[1].'<br>';
   // var_dump($_SESSION["coatArray"]);
    echo "<br>"."****".'<br>';
    $_SESSION["coatArray"][$arraySize] = $newArray;
    var_dump($_SESSION["coatArray"]);
    //echo "<br>"."#######"."<br>";
  //  $_SESSION["coatArray"][2]=array("GOOD", "GREAT");
    //echo $coatArray[$i][0];
    //$GLOBALS['coatCounter']+=1;
    //echo "I: ".$i."<br>";
  //  $_SESSION["counter"]=$arraySize+ =1;
  //$count=$_SESSION["counter"];
    $counter+=1;
	setcookie('counter', $counter, time()+3600, '/');
    //echo "SESSION SIZE: ".$_SESSION["counter"];
  }
  echo "ARR: ".$_SESSION["coatArray"][0][0].'<br>';
  echo "Counter: ", $counter;
  $tempString=null;
  $descrip=null;
  //echo $coatArray[0][0];
 ?>
  <form method="post" action="resetClothes.php">
   <button type="submit">
     Reset </Button>
   </form>
 <div id="coatList">
   <h1> Exisiting Clothing: </h1>
   <div id="desc"> Description: || Temperature range: </div>
   <?php
   for($k = 0; $k < $counter; $k++){
     echo "========".'<br>';
     $arr= $_SESSION["coatArray"][$k];
     echo $arr[0];
     echo "   ||   ";
     echo $arr[1].'<br>';
     echo "========".'<br>';
   }
   $tempString=null;
   $descrip=null;
   ?>
 </div>
 <form method="post" action="input.php">

    <button type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >
      Return to Lat/Long
    </button>
 </form>

</body>

</html>