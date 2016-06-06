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
        <script src="provjera.js"></script>
        <title> Health&amp;Spa centar
            <br>Minnie</title>
    </head>

    <body>




        <?php
    $msg = '';
      $Err='';

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

        
        
        
        
        if (isset($_POST['addnewsbutton'])){


             if (!isset($_POST["headline"]  )) {
    $Err= " Headline is required";
                   echo "<script type='text/javascript'>alert('$Err');</script>";
  }  else if (!isset($_POST["content"] ) || $_POST["content"]=="") {
    $Err =" content is required";
                  echo "<script type='text/javascript'>alert('$Err');</script>";
  } 
         // else if(!isset($_POST["country"]) || !isset($_POST["telephone"] )){echo "greska";}
            else{

                
           $headline=strip_tags($_POST["headline"]);
			//$imagelink=strip_tags($_POST["image"]);
			$content=strip_tags($_POST["content"]);
			$telephone=strip_tags($_POST["telephone"]);
			$country=strip_tags($_POST["country"]);
                $headline = htmlEntities($headline, ENT_QUOTES);
				//$imagelink = htmlEntities($imagelink, ENT_QUOTES); 
				$content = htmlEntities($content, ENT_QUOTES); 
				$country = htmlEntities($country, ENT_QUOTES);
$telephone = htmlEntities($telephone, ENT_QUOTES);
                
           $date=date('Y-m-d H:i:s');
           if(!empty($headline)  && !empty($content) && $content!=""/* && $telephone!="" && $country!=""*/){


          $username=$_SESSION["username"];

         if(!is_dir("slike/".$username))
         {
            mkdir("slike/".$username."");
         }

          

          $folder = "slike/".$username."/";

          $file_slika = $folder.basename($_FILES["slikaFile"]["name"]);

        

          $uploadOk = 1;
          $tip = pathinfo($file_slika,PATHINFO_EXTENSION);

          if (file_exists($file_slika)) {
              $uploadOk = 0;
          }
          if($tip != "jpg" && $tip != "png" && $tip != "jpeg" && $tip != "gif" ) {
              $uploadOk = 0;
          }
          if ($uploadOk == 1) {

            move_uploaded_file($_FILES["slikaFile"]["tmp_name"], $file_slika);

          } 

          

          $upit="SELECT id from korisnik where username='$username'";

          $rezultat=$konekcija->query($upit);

            if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $Autor_id=$row["id"];
                   
                } 
        
            }

          if(isset($_POST["comments"]))
            $mogucnostcomments= true;
          else
                $mogucnostcomments=false;

          $upit = "INSERT INTO obavijest (Naslov,Tekst,Vrijeme,Autor_id,Slika,Drzava,Telefon,Komentari)
          VALUES ('$headline', '$content','$date' ,'$Autor_id', '$file_slika','$country','$telephone','$mogucnostcomments')";




          if ($konekcija->query($upit) === TRUE) {
          header("location: index.php");
          } 


			
            }
            }
		}
            	if(isset($_POST['logoutbutton'])) {
                   
                $_SESSION['loggedIn']=false;
		         session_unset();
                header('Location: index.php');
              
		           }
            else if (isset($_POST['loginbutton']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
      		$brojac=0;
                  $username= $_POST['username'];
                      
                  $passwordHash = hash('md5',$_POST['password'],false);
                  $redovi=file_get_contents("login.csv"); 
      		
			
			
			     $upit = "SELECT * from korisnik where password='$passwordHash' AND username='$username'";

           $rezultat=$konekcija->query($upit);


            if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  $dobarUsername=true;
                  $dobarPassword=true;
                   
                }
           
            
        
            }

                if(!isset($_SESSION['username']))

                { if (isset($dobarUsername) && isset($dobarPassword) && $dobarUsername==true && $dobarPassword==true) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $username;
                  $_SESSION['loggedIn'] = true;
               
		          
                  $message = 'You have entered valid username and password';
echo "<script type='text/javascript'>alert('$message');</script>";
                    
                    header("Location: index.php");
                  
               }else {
                 $message = 'You have entered invalid username or password';
echo "<script type='text/javascript'>alert('$message');</script>";
               }
             }

            }
            
         ?>


            </div>
            <!-- Navigacijski meni -->
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

              <div id="obavijest">

              </div>

            <div class="cover">

                <div class="center">
                    <a id="smaller">Health&amp;Spa centar</a>
                    <br>
                    <a id="larger"> Minnie</a>
                </div>
            </div>
            <?php
        function cmp($a, $b)
{
    $niz=explode(',',$a);
    $niz1=explode(',',$b);
    return (strtolower($niz[1]) < strtolower($niz1[1])) ? -1 : 1;
}
         function cmpAlpha($a, $b)
{
    $niz=explode(',',$a);
    $niz1=explode(',',$b);
    return (strtolower($niz[2]) < strtolower($niz1[2])) ? -1 : 1;
}

       $niz =  array();
       $nizDesno=  array();
      $upit = "SELECT Slika,Vrijeme,Naslov,Tekst,id
              FROM obavijest";

            $brojac=0;
            $brojac1=0;
            $lijevi=1;
        $rezultat =  $konekcija->query($upit);


        if ($rezultat->num_rows > 0) {
               
                while($row = $rezultat->fetch_assoc()) {

                  if($lijevi==1)
                  {
                    $niz[$brojac]=$row["Slika"].",".$row["Vrijeme"].",".$row["Naslov"].",".$row["Tekst"].",".$row["id"];
                    $brojac=$brojac+1;
                    $lijevi=0;
                  }
                  else 
                  {

                 $nizDesno[$brojac1]=$row["Slika"].",".$row["Vrijeme"].",".$row["Naslov"].",".$row["Tekst"].",".$row["id"];
                  $brojac1=$brojac1+1;
                  $lijevi=1;

                  }


                   
                }

           
            
        
            }


        $novosti=$niz;

        if(isset($_POST["sortAbutton"]))        $selectedKey=0;
        else 
           $selectedKey=1;
       if($selectedKey==1)
       usort($novosti, "cmp");
        else
            usort($novosti, "cmpAlpha");
		print "<div id='leftie' class='newsleft'>";
		foreach ($novosti as $red){
            $brojac=0;
            	print "<div class='post'>";
			$celije= explode(',', $red);
            $brojac=0;
			foreach ($celije as $celija){
                 if($brojac==0) {
                    print "<img class='newsicon' src=$celija alt='Image could not be loaded'>";
                  
                }
                 else if ($brojac==1){
                      print "<label class='datelabel'>$celija</label>";
                    print "<label class='pomlabel'></label>";
                    
                }
                else if($brojac==2) {print "<h3><a href='novost.php?obavijestid=".$celije[4]."'>$celija</a></h3>"; }
                else if ($brojac==3){
                    print "<span>$celija<span>";
                
                }
               
                   $brojac++;
			}
			print "</div>";
		}
        print "</div>";
        ?>

                <?php

                $novostidesno=$nizDesno;
         
          if(!isset($_POST["sortAbutton"]))    
       usort($novostidesno, "cmp");
        else
            usort($novostidesno,"cmpAlpha");
		print "<div class=\"newsright\">";
		foreach ($novostidesno as $red){
            $brojac=0;
            	print "<div class='post'>";
			$celije= explode(',', $red);
            $brojac=0;
			foreach ($celije as $celija){
                 if($brojac==0) {
                    print "<img class='newsicon' src=$celija alt='Image could not be loaded'>";
                  
                }
                 else if ($brojac==1){
                      print "<label class='datelabel'>$celija</label>";
                    print "<label class='pomlabel'></label>";
                    
                }
                else if($brojac==2) {print "<h3><a href='novost.php?obavijestid=".$celije[4]."'>$celija</a></h3>"; }
                else if ($brojac==3){
                    print "<span>$celija<span>";
                
                }
               
                   $brojac++;
			}
			print "</div>";
		}
        print "</div>";
        ?>

                    <div class="addnews">
                        <?php
        if(!isset($_SESSION['loggedIn'])){
            print("
         <form class='loginforma' method='post'>
        <p class='username'>
            <label for'username'>Username:</label>
            <input name='username' type=text class='username' placeholder='' id='headlinearea' required/>
        </p>
          <p class='password'>
            <label for='password'>Password:</label>
            <input name='password' type=password class='password' placeholder='' id='headlinearea' required/>
        </p>
             <input type='submit' value='Login' id='loginbutton' name='loginbutton' />
            <br><br>
        
    </form>");
        }
        else{
             print("       <p class='headline'>
                      <form novalidate method='post' enctype='multipart/form-data' action='index.php' onsubmit='return addElement()'>
                      <label for='headline'>Headline:</label>
                        <input name='headline' type=text class='news' placeholder='' id='headlinearea'/>
                    </p>
                    <p class='image'>
                        <label for='image'>Image link:
                            <br>
                        </label>
                        <input  type='file' name='slikaFile' id='slikaFile'>
                       
                    </p>
                    <p class='content'>
                        <label for='content'>Text:
                            <br>
                        </label>
                        <textarea id='contentarea' name='content' rows='4'> </textarea>
                    </p>
                    <p class='country'>
                        <label for='country'>Country:
                            <br>
                        </label>
                          <input name='country' type=text class='country' id='country' onchange='validateAJAX();' />
                  
                    </p>
                    <p class='telephone'>
                        <label for='telephone'>Telephone:
                            <br>
                        </label>
                          <input name='telephone' type=text class='telephone' id='telephone'  onchange='validateAJAX();'/>
                  
                    </p>

                     <p class='telephone'>
                        <label for='comments'>Comments:
                            <br>
                        </label>
                          <input name='comments' type=checkbox class='telephone' id='telephone'   />
                  
                    </p>
                    <input type='submit'  name='addnewsbutton' value='ADD NEWS' id='addnewsbutton' /> 
                    <br> <br>
                    <input type='submit' name='sortAbutton' value='SORT ALPHABETICALLY' id='sortAbutton'/>
                     <input type='submit' name='sortDbutton' value='SORT BY DATE' id='sortDbutton'/>
                    
                         
                    </form><br><br>"
                    );
        }
        ?>
                            <select id="dropdown" onchange="dropdownChanged()">
                                <option value="sve">Sve novosti</option>
                                <option value="danasnje">Danasnje novosti</option>
                                <option value="sedmicne">Novosti ove sedmice</option>
                                <option value="mjesecne">Novosti ovog mjeseca</option>
                            </select>


                    </div>

    </body>

    </html>