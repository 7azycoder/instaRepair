<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>instaRepair</title>
  <link rel="shortcut icon" type="images/x-icon" href="images/favicon.png">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

 <?php 
 require('header.php');
 ?>

  <main class="mdl-layout__content">
    <div class="page-content">
      



  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Nearest Repair Shop</h4>
          <div class="row">
          <form class="col s12" action="">
              <div class="row">
                <div class="input-field col s12">
                  <input id="txt1" type="text" onkeyup="showHint(this.value)">
                  <label for="txt1">Search for Repair Shop</label>
                </div>
              </div>
          </form>

          <!--form action=""> 
          First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
          </form-->


          </div>
    </div>
    </div>

    <div class="row">
        <div class="col s12 center">
         
          <h5>Search results</h5>
          <p><span id="txtHint"></span></p> 
         

        </div>
      </div>


    </div>
    </div>
    </div>
    </main>

<script>
function showHint(str) {
  var xhttp;
  if (str.length == 0) { 
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("txtHint").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "searchQueryScript.php?q="+str, true);
  xhttp.send();   
}
</script>

<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/material.js"></script>
  <script src="js/init.js"></script>


</body>
</html>

