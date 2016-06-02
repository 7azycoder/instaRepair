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
          <form class="col s12" id="searchForm" name="searchForm">
              <div class="row">
                <div class="input-field col s12">
                  <input id="searchTerm" type="text" name="searchTerm" autocomplete="off">
                  <label for="searchTerm">Search for Repair Shop</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s4">
                 <select id="shopCategory" name="shopCategory">
                    <option value="none" selected>None</option>
                    <option id="electronics" value="electronics" >Electronics</option>
                    <option id="computers" value="computers">Computers</option>
                    <option id="mobiles" value="mobiles">Mobiles</option>
                  </select>
                  <label>Shop Category</label>
                
                </div>
                <div class="input-field col s4">
                 <select id="shopLevel" name="shopLevel">
                    <option value="none"  selected>None</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                   
                  </select>
                   <label>Shop Level</label>
                 
                </div>

               <div class="input-field col s4">
                          
                    <button class="btn waves-effect waves-light" id="search" type="submit" value="submit">Search
                                
                    </button>
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



<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/material.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript">
$(document).ready(function() {
$("#search").click(function() {
var searchTerm = $("#searchTerm").val();
var shopLevel = $("#shopLevel").val();
var shopCategory = $("#shopCategory").val();

var dataString = 'searchTerm=' + searchTerm + '&shopLevel=' + shopLevel + '&shopCategory=' + shopCategory;

// Returns successful data submission message when the entered information is stored in database.
$.ajax({
type: "POST",
url: "searchQueryScript.php",
data: dataString,
cache: false,
success: function(result){

var data="";
data=JSON.parse(result);
$("#txtHint").html(data);
}
});

return false;
});
});
</script>


</body>
</html>

