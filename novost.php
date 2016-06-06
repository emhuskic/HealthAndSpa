<?php
   ob_start();
   session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <script src="script.js"></script>
        <title> Health&amp;Spa centar
            <br>Minnie</title>
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
        


      if(isset($_GET["obavijestid"]))
      {

        $obavijestid = $_GET["obavijestid"];

          if(isset($_POST["omoguci"]))
          {
            

             $sql="UPDATE obavijest
              SET `Komentari`= \"1\"
              WHERE `id` = $obavijestid";

        $konekcija->query($sql);


          }

          if(isset($_POST["iskljuci"]))
          {
            

             $sql="UPDATE obavijest
              SET `Komentari`= false
              WHERE `id` = $obavijestid";

        $konekcija->query($sql);


          }

       $upit = "SELECT * 
              FROM obavijest where id='$obavijestid'";
        $rezultat =  $konekcija->query($upit);


        if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $naslov=$row["Naslov"];
                  $tekst=$row["Tekst"];
                  $vrijeme =$row["Vrijeme"];
                  $autorID=$row["Autor_id"];
                  $slika = $row["Slika"];
                  $drzava = $row["Drzava"];
                  $Telefon =$row["Telefon"];
                  $komentari = $row["Komentari"];
                  $brNovihKom=$row["BrojKomentara"];
                   
                }

      }


      $upit = "SELECT Ime, Prezime
              FROM korisnik where id='$autorID'";
              $rezultat =  $konekcija->query($upit);


        if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $ime=$row["Ime"];
                  $prezime=$row["Prezime"];
                 
                   
                }

      }
    }

    else {

      return;
    }


    if(isset($_POST["deletePost"]))
    {

      $sql="DELETE from obavijest where id='$obavijestid'";

      if ($konekcija->query($sql) === TRUE) {
          header("Location:index.php");
        }


    }


    if(isset($_POST["deleteComment"]))
    {
      $komentarid=$_POST["komentarid"];

      $sql="DELETE from komentar where id='$komentarid'";

      if ($konekcija->query($sql) === TRUE) {
       
        }


    }


    if(isset($_POST["deleteReply"]))
    {
      $replikaid=$_POST["replikaid"];

      $sql="DELETE from komentarodgovor where id='$replikaid'";

      if ($konekcija->query($sql) === TRUE) {
       
        }


    }

   


    if(isset($_POST["commentpost"]))
    {
      $datum = date("Y-m-d h:i:sa");

      $komentar= $_POST["comment"];


    $sql ="SELECT  `BrojKomentara`
    FROM `obavijest` 
    WHERE `id` = '$obavijestid' ";

    $result1=$konekcija->query($sql);


    if ($result1->num_rows > 0) {
       
        while($row = $result1->fetch_assoc()) {
            
            $brNovihKoment1=$row["BrojKomentara"];
          

        }
    }

        $brNovihKoment1= $brNovihKoment1+1;

        $sql="UPDATE `obavijest`
        SET `BrojKomentara`=\"$brNovihKoment1\"
        WHERE `id` = $obavijestid";

     $konekcija->query($sql);

      if(isset($_POST["usernamecomment"]))
      {
          $user=$_POST["usernamecomment"];

           $sql = "INSERT INTO komentar (Tekst,Autor_id,Vijest_id,Vrijeme,AnonimniKorisnik)

        VALUES ('$komentar', '0','$obavijestid','$datum','$user')";

        if ($konekcija->query($sql) === TRUE) {
          //super;
        }
      }
      else{


          $username=$_SESSION["username"];

         $upit="SELECT id from korisnik where username='$username'";

          $rezultat=$konekcija->query($upit);

            if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $Komentarista=$row["id"];
                   
                } 
        
            }

             $sql = "INSERT INTO komentar (Tekst,Autor_id,Vijest_id,Vrijeme)

        VALUES ('$komentar', '$Komentarista','$obavijestid','$datum')";

        if ($konekcija->query($sql) === TRUE) {
          //super;
        }


      }




    }


    if(isset($_POST["replypost"]))
    {
      $datum = date("Y-m-d h:i:sa");

      $reply= $_POST["comment"];

      $komentarid=$_POST["komentarid"];

      if(isset($_POST["usernamecomment"]))
      {
          $user=$_POST["usernamecomment"];

           $sql = "INSERT INTO komentarodgovor (Tekst,Autor_id,Komentar_id,Vrijeme,AnonimniKorisnik)

        VALUES ('$reply', '0','$komentarid','$datum','$user')";

        if ($konekcija->query($sql) === TRUE) {
          //super;
        }
      }
      else{


          $username=$_SESSION["username"];

         $upit="SELECT id from korisnik where username='$username'";

          $rezultat=$konekcija->query($upit);

            if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $Komentarista=$row["id"];
                   
                } 
        
            }

             $sql = "INSERT INTO komentarodgovor (Tekst,Autor_id,Komentar_id,Vrijeme)

        VALUES ('$reply', '$Komentarista','$komentarid','$datum')";

        if ($konekcija->query($sql) === TRUE) {
          //super;
        }


      }




    }

     if(isset($_SESSION['username']))
         {

             $usernameUsera=$_SESSION['username'];

      $sql= "SELECT  `id` 
            FROM  `korisnik` 
            WHERE  `username` =  '$usernameUsera'";
            $result=$konekcija->query($sql);


            if ($result->num_rows > 0) {
               
                while($row = $result->fetch_assoc()) {
                    $korisnikovIDUsera= $row["id"];
                }
            }


            if($korisnikovIDUsera==$autorID)
            {
                $brNovihKom=0;

                 $sql="UPDATE `obavijest`
        SET `BrojKomentara`=\"$brNovihKom\"
        WHERE `id` = $obavijestid";

     $konekcija->query($sql);
            }
            

    

   

}


      ?>




            <ul class="navbar">
                <li>
                    <a id="cvjetic" href="index.php">
                        <div class="logo">
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
                        </div>
                    </a>
                </li>
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


          <div class="postObavijesti">
           

           <div class="postSlikaDiv">

            <img <?php echo "src='".$slika."'" ?> alt="" class="slikaPost">

           </div>

           <div class="textura">

            <?php
                   if($admin==1)
                   { ?>

                    <form <?php echo "action='novost.php?obavijestid=".$obavijestid."'" ?> method='post' >

                    <input type='submit'  name='deletePost' value='Delete post' id='addnewsbutton' class="deleteButton" /> 

                  </form>

                    <?php if($komentari==1) { ?>
                   <form <?php echo "action='novost.php?obavijestid=".$obavijestid."'" ?> method='post' >

                    <input type='submit'  name='iskljuci' value='Iskljuci komentare' id='addnewsbutton' class='deleteButton' /> 

                   </form>
                   <?php } ?>
                  <?php }?>


           </div>

          <div class="podaci">

            <label>Naslov</label>
            <p><?php echo $naslov; ?></p>
            <label>Tekst</label>
            <p><?php echo $tekst; ?></p>
            <label>Vrijeme objave</label>
            <p><?php echo $vrijeme; ?></p>
            <label>Autor</label>
            <p><a <?php echo "href='profil.php?idAutora=".$autorID."'";?>><?php echo $ime; echo " "; echo $prezime; ?></a></p>
            <label>Telefon</label>
            <p><?php echo $Telefon; ?></p>


          </div>

          </div>


          <?php if($komentari==1) { ?>
          

            <?php 

              $upit ="SELECT * from komentar where Vijest_id = '$obavijestid'";


              $rezultat = $konekcija->query($upit);

              if ($rezultat->num_rows > 0) {

                while($row = $rezultat->fetch_assoc()) {

                $idAut=$row["Autor_id"];

                if($idAut!=0)
                {
                  
                  $upit1="SELECT Username from korisnik where id = '$idAut'";

                  $rezultat1=$konekcija->query($upit1);

                  if ($rezultat1->num_rows > 0) {
                     while($roww = $rezultat1->fetch_assoc()) {
                      $username=$roww["Username"];


                     }

                  }

                }
                
                else
                {
                     $username=$row["AnonimniKorisnik"];

                }
                
               
               

                 
                 print "<div class='komentar'>

                  <label class='komentarTekst'> Korisnik :  <a href='profil.php?idAutora=".$idAut."'>".$username." </a></label>
                  </br>
                  <label class='komentarTekst'> Vrijeme : ".$vrijeme." </label>
                  <p class='replyTekst'> <a href='javascript:reply(".$row["id"].")'> Reply </a> </p>";

                  
                   if($admin==1)
                   { 

                   print "<form  action='novost.php?obavijestid=".$obavijestid."'  method='post' >

                   
                    <input  name='komentarid' value = '".$row["id"]."' hidden>

                     <input type='submit'  name='deleteComment' value='Delete'   class='deleteButtonComment' /> 

                  </form>";
                  }


         
                  print "<p class='komentarTekst'> ".$row["Tekst"]." </p>


                  </div> ";

               


                    $idKomentara=$row["id"];
                     $upit2 ="SELECT * from komentarodgovor where Komentar_id = '$idKomentara'";


              $rezultat2 = $konekcija->query($upit2);

              if ($rezultat2->num_rows > 0) {

                while($rowe = $rezultat2->fetch_assoc()) {

                $idAutor=$rowe["Autor_id"];

                if($idAutor!=0)
                {
                  
                  $upit1="SELECT Username from korisnik where id = '$idAutor'";

                  $rezultat1=$konekcija->query($upit1);

                  if ($rezultat1->num_rows > 0) {
                     while($roww = $rezultat1->fetch_assoc()) {
                      $usernameOdgovor=$roww["Username"];


                     }

                  }

                }
                
                else
                {
                     $usernameOdgovor=$rowe["AnonimniKorisnik"];

                }
                
                  
                  print "<div class='odgovor'>

                  <label class='komentarTekst'> Korisnik : <a href=' profil.php?idAutora=".$idAutor."'> ".$usernameOdgovor." </a> </label>
                  </br>
                  <label class='komentarTekst'> Vrijeme : ".$rowe["Vrijeme"]." </label>";

                  if($admin==1)
                   { 

                   print "<form  action='novost.php?obavijestid=".$obavijestid."'  method='post' >

                   
                    <input  name='replikaid' value = '".$rowe["id"]."' hidden>

                     <input type='submit'  name='deleteReply' value='Delete'   class='deleteButtonComment' /> 

                  </form>";
                  }


                 print" <p class='komentarTekst'> ".$rowe["Tekst"]." </p>

                  </div>";


                    



           
                 
                   
                }
              }

               print "  <form action='novost.php?obavijestid=".$obavijestid."' method='post' class='formaReply' id='forma".$row["id"]."' hidden>";
                   if(!isset($_SESSION['username']))
                   {

                    print " <p class='username'>
            <label for'username'>Nick:</label>
            <input name='usernamecomment' type=text class='username' placeholder='' id='headlinearea' />
        </p>";

                   } 

                print "<p class='content'>
                        <label for='content'>Comment:
                            <br>
                        </label>
                        <textarea id='contentarea' name='comment' rows='4'> </textarea>
                    </p>
                    <input id='komentarid' name='komentarid' value = '  ".$row["id"]."' hidden>

                    <input type='submit'  name='replypost' value='POST' id='addnewsbutton' /> 

                  </form>";

               

             }
           }


            ?>

             <div class="postaviKomentar">

              <form <?php echo"action='novost.php?obavijestid=".$obavijestid."'" ?> method="post">
                  <?php if(!isset($_SESSION['username']))
                   {

                    print " <p class='username'>
            <label for'username'>Nick:</label>
            <input name='usernamecomment' type=text class='username' placeholder='' id='headlinearea' />
        </p>";

                   } ?>
                 <p class='content'>
                        <label for='content'>Comment:
                            <br>
                        </label>
                        <textarea id='contentarea' name='comment' rows='4'> </textarea>
                    </p>

                    <input type='submit'  name='commentpost' value='POST' id='addnewsbutton' /> 

                  </form>

               </div>


              

        

          <?php } else { print "<h1>Komentari za ovaj post nisu omoguceni</h1>"; if($admin==1) {?>

          <form <?php echo "action='novost.php?obavijestid=".$obavijestid."'" ?> method='post' >

                    <input type='submit'  name='omoguci' value='Omoguci komentare' id='addnewsbutton' class='omoguciButton' /> 

          </form>

                  

                  <?php }} ?>


    </body>




    </html>