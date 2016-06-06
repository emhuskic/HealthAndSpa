
<?php
   ob_start();
   session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="servicestyle.css">
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
       if(isset($_POST['logoutbutton'])) {
                   
                $_SESSION['loggedIn']=false;
		         session_unset();
                header('Location: index.php');
              
		           }
        else if(isset($_SESSION["username"]))
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
    <!-- Navigacijski meni -->
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
  
   <table  id="table1">
  <caption>* O U R *<br>  * S E R V I C E S *</caption>
  <tr>
    <th>Service</th>
    <th>Duration</th>
    <th>Details</th>
    <th>Price (KM)</th>
    <th>Discount</th>
  </tr>
  <tr>
    <td>Woodsman Massage</td>
    <td>80min.</td>
    <td>Designed for men, this service combines several therapeutic massage techniques to reduce tension, alleviate muscular pain and increase flexibility. </td>
     <td>100</td>
     <td>10%</td>
  </tr>
  <tr>
     <td>Bamboo Bliss</td>
    <td>80min.</td>
    <td>Melt away tension through the skillful manipulation of warm bamboo. Experience a full body massage customized to your needs for relaxation or deep tissue release.  Not recommended during pregnancy.</td>
     <td>179</td>
     <td>10%</td>
  </tr>
   <tr>
     <td>Aromatherapy Massage</td>
    <td>70min.</td>
    <td>Aromatherapy Massage
After a brief consultation, your therapist will help you choose a blend of essential oils to perform a personalized Aromatic Massage.  Not recommended during pregnancy. </td>
     <td>185</td>
     <td>5%</td>
  </tr>
   <tr>
     <td>Dermaplaning</td>
    <td>30min.</td>
    <td> A simple and safe procedure, dermaplaning exfoliates the epidermis and rids the skin of fine vellus hair. Using a scalpel and a delicate touch, we remove the top layer of dead skin with light feathering strokes.</td>
     <td>45</td>
     <td>10%</td>
  </tr>
   <tr>
     <td>Reiki</td>
    <td>90min.</td>
    <td>
 Reiki is best described as a healing technique that attunes the energy flow within the body allowing for your natural healing processes to occur. </td>
     <td>164</td>
     <td>15%</td>
  </tr>
</table>
    
  </body>

</html>