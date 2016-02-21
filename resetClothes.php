<?php session_start(); ?>
<html>
<body>
  <?php
$_SESSION["counter"]=0;
$_SESSION["coatList"]=null;
echo "Resetted Clothes.";
   ?>

   <form method="post" action="index.php">

      <button type = "submit" id="button" style= "color: #cc99ff; background-color: #0066ff; opacity: 0.5;" >
        Return to Lat/Long.
      </button>
   </form>
</body>
</html>