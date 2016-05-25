 <!-- Always shows a header, even in smaller screens. -->

  <header class="mdl-layout__header white grey-text">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <a class="mdl-layout-title"><img class="responsive-img" src="images/logo.png"></a>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
     

      <nav class="mdl-navigation mdl-layout--large-screen-only grey-text">
        
        <a class="mdl-navigation__link " href="../index.php">Home</a>
        
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer white grey-text">
    <a class="mdl-layout-title"><img class="responsive-img" src="images/logo.png"></a>
    
    <nav class="mdl-navigation">
      <li class="divider"></li>
      <a class="mdl-navigation__link" href="#" id="viewProfile">View Your Profile</a>
      <a class="mdl-navigation__link" href="#" id="editProfile">Edit Your Profile</a>
      <a class="mdl-navigation__link" href="#" id="passwordChange">Change Password</a>
      <a class="mdl-navigation__link" href="#" id="profilePicChange">Change Profile Picture</a>
      <li class="divider"></li>
      <a class="mdl-navigation__link" href="#" id="viewShop">View Shop Details</a>
      <a class="mdl-navigation__link" href="#" id="editShop">Edit Shop Details</a>
      <a class="mdl-navigation__link" href="#" id="shopPicChange">Change Shop Picture</a>
      <li class="divider"></li>
      <a class="mdl-navigation__link" href="logout.php" id="logout">Logout</a>
    </nav>
  </div>