
<?php
   ob_start();
   session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="linkstyle.css">
       <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat">
  
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="script.js"></script>
    <title> Health&amp;Spa centar<br>Minnie</title>
  </head>

  <body>

    <?php 


      $servername = "localhost";
      $dbname = "eminawt";
      $username = "root";
      $password = "";
      $konekcija = new mysqli($servername, $username, $password,$dbname);

       $admin=0;
        if(isset($_SESSION["username"]))
        {

          $username=$_SESSION["username"];

         $upit="SELECT Admin from korisnik where username='$username'";

          $rezultat=$konekcija->query($upit);

            if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $admin=$row["Admin"];
                   
                } 
        
            }
          }




    ?>
      <div class="imageblur"> </div>
    <!-- Navigacijski meni -->
       <ul class="navbar">
    <li><a id="cvjetic" href="index.php"><div class="logo">
			<div id="cvijet"></div>
			<div id="sredina"></div>
			<div id="latica1"></div>
			<div id="latica2"></div>
			<div id="latica3"></div>
			<div id="latica4"></div>
			<div id="latica5"></div>
			<div id="latica6"></div>
			<div id="latica7"></div>
			<div id="latica8"></div>
		</div></a></li>
    <li><a class="tekst" href="index.php">Home page</a>
    <li><a class="tekst" href="services.php">Services</a>
    <li><a class="tekst" href="contact.php">Contact</a>
    <li><a class="tekst" href="link.php">Links</a>
      <?php if(isset($_SESSION["loggedIn"])) { 
        if($admin==1){
                                print "<li><a class='tekst' href='admin.php'>Admin panel</a>";
                              }

        ?> <li><form class='logoutforma' method='post' >
       <input type='submit' value='Logout' id='logoutbutton' name='logoutbutton' /></form> <?php } ?>
  </ul>



<ul class="links">
  <li><a href=" http://www.united-chiropractic.org/">United Chiropractic Association</a></li>
  <li><a href="http://www.who.int/en/">World Health Organisation</a></li>
  <li><a href=" http://www.live-well.uk.com/">Live Well</a></li>
</ul>
    
  </body>

</html>