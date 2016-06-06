<?php
   ob_start();
   session_start();


      $servername = "localhost";
      $dbname = "eminawt";
      $username = "root";
      $password = "";
    
  /*  $servername = "127.6.241.130";
$username = "admin61vmZBV";
$password = "rnu3mlMX-Wz8";
$dbname = "eminawt";*/
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

          if($admin==1){
?>

<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="contactstyle.css">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat">
      
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="contactscript.js"></script>
    <title> Health&amp;Spa centar<br>Minnie</title>
  </head>

  <body>

    <?php 




         


          if(isset($_POST["spasiButton"]))
          {

              $ime=$_POST["ime"];
              $prezime=$_POST["prezime"];
              $brojTel=$_POST["brojTelefona"];
              $username=$_POST["username"];
              $password=$_POST["password"];
              $id=$_POST["id"];


              if($id==0)
              {
                      $passwordHash = hash(md5,$password,false);

                        $upit = "INSERT INTO korisnik (Ime,Prezime,BrojTelefona,Username,Password,Admin)
                  VALUES ('$ime', '$prezime','$brojTel' ,'$username', '$passwordHash',0)";




                  if ($konekcija->query($upit) === TRUE) {
                  header("location: admin.php");
                  } 
               }
               else{

                      if($password=="")
                      {
                     

                        $upit = "UPDATE  korisnik
                        SET Ime=\"$ime \", Prezime=\"$prezime \",BrojTelefona=\"$brojTel \",Username=\"$username \"
                        where id='$id'";
                      }
                      else
                      {
                          $passwordHash = hash(md5,$password,false);
                            $upit = "UPDATE  korisnik
                        SET Ime=\"$ime \", Prezime=\"$prezime \",BrojTelefona=\"$brojTel \",Username=\"$username \",Password=\"$passwordHash\"
                        where id='$id'";

                      }


                  if ($konekcija->query($upit) === TRUE) {
                  header("location: admin.php");
                  } 

               }




          }


          if(isset($_POST['logoutbutton'])) {
                   
                $_SESSION['loggedIn']=false;
             session_unset();
                header('Location: index.php');
              
               }


      

    




     
          
    ?>
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
    <li><a class="tekst" href="links.php">Links</a>
      <?php if(isset($_SESSION["loggedIn"])) { 
        if($admin==1){
                                print "<li><a class='tekst' href='admin.php'>Admin panel</a>";
                              }

        ?> <li><form class='logoutforma' method='post' >
       <input type='submit' value='Logout' id='logoutbutton' name='logoutbutton' /></form> <?php } ?>
  </ul>



  <div class="unosNovog">

    <label>Dodaj/Uredi korisnika:</label>
    <form action="admin.php" method="post">

       <input name='id' type=text class='username sirinaUnosa' placeholder='' value='0' id='id'  hidden/>

        <p class='ime'>
            <label for'ime'>Ime:</label>
            <input name='ime' type=text class='username sirinaUnosa' placeholder='' id='ime' />
        </p>
        <p class='prezime'>
            <label for'prezime'>Prezime:</label>
            <input name='prezime' type=text class='username sirinaUnosa' placeholder='' id='prezime' />
        </p>
        <p class='brojTelefona'>
            <label for'brojTelefona'>Broj telefona:</label>
            <input name='brojTelefona' type=text class='username sirinaUnosa' placeholder='' id='brojTelefona'/>
        </p>
        <p class='username'>
            <label for'username'>Username:</label>
            <input name='username' type=text class='username sirinaUnosa' placeholder='' id='usernamee' />
        </p>
        <p class='password'>
            <label for'password'>Password:</label>
            <input name='password' type=text class='username sirinaUnosa' placeholder='' id='password' />
        </p>

        <input type='submit' value='Spasi' id='loginbutton' name='spasiButton' />

    </form>

    <input  type='submit' value='Ocisti polja' id='ocistiButton' onclick='javascript:ocisti()' name='spasiButton1' />



  </div>

  <div class="listaKorisnika">

    <h3>Lista korisnika</h3>

    <?php 

      $sql = "SELECT Ime, Prezime, BrojTelefona,Username,Password, id from korisnik";

      $rezultat = $konekcija->query($sql);

      if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  
                  print "<label id='korisnik".$row["id"]."'>
                   ".$row["Ime"]." ".$row["Prezime"]."
                   <label id='ime".$row["id"]."' hidden>".$row["Ime"]." </label>
                   <label id='prezime".$row["id"]."' hidden>".$row["Prezime"]." </label>
                   <label id='brojTel".$row["id"]."' hidden>".$row["BrojTelefona"]." </label>
                   <label id='username".$row["id"]."' hidden>".$row["Username"]." </label>
                   <label id='password".$row["id"]."' hidden>".$row["Password"]." </label>

                   <input type='submit' value='Uredi' id='uredi".$row["id"]."' onclick='javascript:uredi(".$row["id"].")' name='uredi' class='dugmadUredjivanja' />
                  <input type='submit' value='Obrisi' id='obrisi".$row["id"]."'  onclick='javascript:obrisi(".$row["id"].")' name='obrisi' class='dugmadUredjivanja' />
                   </label> <br/> ";
                   
                }

      }


    ?>


  </div>

  
  
  </body>



  <script type="text/javascript">

    function uredi (id) {

      var ime = document.getElementById("ime"+id);
      var prezime = document.getElementById("prezime"+id);
      var brojTel = document.getElementById("brojTel"+id);
      var username = document.getElementById("username"+id);
     // var password = document.getElementById("password"+id);

      var imeInput = document.getElementById("ime");
      var prezimeInput = document.getElementById("prezime");
      var brojTelInput = document.getElementById("brojTelefona");
      var usernameInput = document.getElementById("usernamee");
      var idInput = document.getElementById("id");

      imeInput.value=ime.textContent;
      prezimeInput.value=prezime.textContent;
      brojTelInput.value=brojTel.textContent;
      usernameInput.value=username.textContent;
      idInput.value=id;

      



    }

    function obrisi (id) {

    

        window.location= "obrisi.php?id="+id;
        
      



    }

    function ocisti (){

      var imeInput = document.getElementById("ime");
      var prezimeInput = document.getElementById("prezime");
      var brojTelInput = document.getElementById("brojTelefona");
      var usernameInput = document.getElementById("usernamee");
      var idInput = document.getElementById("id");
      var password = document.getElementById("password");

      imeInput.value="";
      prezimeInput.value="";
      brojTelInput.value="";
      usernameInput.value="";
      password.value="";
      idInput.value=0;

    }


  </script>

</html>

<?php } ?>