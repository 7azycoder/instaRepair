<?php	
require_once('core/init.php');	

$shopCategory = $_POST['shopCategory'];
$shopLevel = $_POST['shopLevel'];
$searchTerm = $_POST['searchTerm'];


$con = mysqli_connect('localhost','root','','instaRepair');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"instaRepair");


$sql="";

if($searchTerm == "" && $shopCategory != "" && $shopLevel=="" ){
  $sql="SELECT * FROM shopkeeper  
WHERE shopCategory like '%$shopCategory%'
ORDER BY shopName ASC"; 

} elseif($searchTerm == "" && $shopCategory == "" && $shopLevel!="" )
{ 
  $sql="SELECT * FROM shopkeeper  
WHERE shopLevel like '%$shopLevel%'
ORDER BY shopName ASC"; 

} elseif ($searchTerm != "" && $shopCategory == "" && $shopLevel=="" ) {
    $sql="SELECT * FROM shopkeeper  
WHERE shopName like '%$searchTerm%' OR shopDescription like '%$searchTerm%' OR shopAddress like '%$searchTerm%'
ORDER BY shopName ASC"; 

  } elseif ($searchTerm != "" && $shopCategory != "" && $shopLevel=="") {
    $sql="SELECT * FROM shopkeeper  
WHERE shopName like '%$searchTerm%' OR shopDescription like '%$searchTerm%' OR shopAddress like '%$searchTerm%' AND shopCategory like '%$shopCategory%'
ORDER BY shopName ASC"; 
  }
  elseif ($searchTerm != "" && $shopCategory == "" && $shopLevel!="") {
    $sql="SELECT * FROM shopkeeper  
WHERE shopName like '%$searchTerm%' OR shopDescription like '%$searchTerm%' OR shopAddress like '%$searchTerm%' AND shopLevel like '%$shopLevel%'
ORDER BY shopName ASC"; 
  }

  elseif($searchTerm == "" && $shopCategory != "" && $shopLevel!=""){
     $sql="SELECT * FROM shopkeeper  
WHERE shopLevel like '%$shopLevel%' AND shopCategory like '%$shopCategory%'
ORDER BY shopName ASC"; 
  }
  elseif($searchTerm != "" && $shopCategory != "" && $shopLevel!=""){
    $sql="SELECT * FROM shopkeeper  
WHERE shopName like '%$searchTerm%' OR shopDescription like '%$searchTerm%' OR shopAddress like '%$searchTerm%' AND shopLevel like '%$shopLevel%'AND shopCategory like '%$shopCategory%' 
ORDER BY shopName ASC"; 
  }


$result = mysqli_query($con,$sql);

$hint = "";

//loop through results and get variables	
while ($row=mysqli_fetch_array($result)){

$shopNo=$row["shopNo"];	
$shopLevel=$row["shopLevel"];	
$shopCategory=$row["shopCategory"]; 
$shopName=$row["shopName"];	
$shopDescription=$row["shopDescription"];	
$shopAddress=$row["shopAddress"];	
$shopImage=$row["shopImage"];	
$shopContactNo=$row["shopContactNo"];
$shopEmail=$row["shopEmail"];

//assign a variable name to the image name	
$filename = "shopkeeper/images/shopImages/$shopImage";
	

$hint .= '<div class="row">
                  <div class="col s12 card-panel">
                        <div class="row">
                        <div class="col s4">
                         <div class="card">
                          <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator responsive-img" src="' .$filename. '" >
                          </div>
                          </div>
                        </div>
                        
                        <div class="col s8">
                             <div class="card-panel teal">
                              <span class="white-text">
                                  <div>Shop No : ' . $shopNo . '</div>
                                  <div>Shop Name : ' . $shopName . '</div>
                                  <div>Shop Description : ' . $shopDescription . '</div>
                                  <div>Shop Address : ' . $shopAddress . '</div>
                                  <div>Shop Level : ' . $shopLevel . '</div>
                                  <div>Shop Level : ' . $shopCategory . '</div>
                                  <div>Shop Contact No : ' . $shopContactNo . '</div>
                                  <div>Shop Email : ' . $shopEmail . '</div>

                                 
                              </span>
                            </div>
                        </div>
                        </div>
                  </div>
              </div>';

}
// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "No result found !" : $hint;

?>