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
    $msg = '';
      $Err='';
     
        
        
        
        
        
        if (isset($_POST['addnewsbutton'])){
             if (!isset($_POST["headline"] )) {
    $Err= " Headline is required";
                   echo "<script type='text/javascript'>alert('$Err');</script>";
  } else if (!isset($_POST["image"] )) {
    $Err= " image is required";
                  echo "<script type='text/javascript'>alert('$Err');</script>";
  } else if (!isset($_POST["content"] ) || $_POST["content"]=="") {
    $Err =" content is required";
                  echo "<script type='text/javascript'>alert('$Err');</script>";
  } 
          else if(!isset($_POST["country"]) || !isset($_POST["telephone"] )){echo "greska";}
            else{
                
           $headline=strip_tags($_POST["headline"]);
			$imagelink=strip_tags($_POST["image"]);
			$content=strip_tags($_POST["content"]);
			$telephone=strip_tags($_POST["telephone"]);
			$country=strip_tags($_POST["country"]);
                $headline = htmlEntities($headline, ENT_QUOTES);
				$imagelink = htmlEntities($imagelink, ENT_QUOTES); 
				$content = htmlEntities($content, ENT_QUOTES); 
				$country = htmlEntities($country, ENT_QUOTES);
$telephone = htmlEntities($telephone, ENT_QUOTES);
                
           $date=date('Y-m-d H:i:s');
           if(!empty($headline) && !empty($imagelink) && !empty($content) && $content!="" && $telephone!="" && $country!=""){
                file_put_contents($_ENV['OPENSHIFT_DATA_DIR']."novosti.csv","\n".$imagelink.','.$date.','.$headline.','.$content, FILE_APPEND);
			
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
            $redovi=file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."login.csv"); 
		foreach ($redovi as $red){
			
			
			$celije= explode(',', $red);
            $dobarUsername=false;
            $dobarPassword=false;
            	foreach ($celije as $celija){
				if($brojac==0 && $celija==$username) $dobarUsername=true;
				if($brojac==1 && $celija==$passwordHash) $dobarPassword=true;
                $brojac++;
			}
           
            
        
            }
                 if (isset($dobarUsername) && isset($dobarPassword) && $dobarUsername==true && $dobarPassword==true) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'emina';
                   
                  $_SESSION['loggedIn'] = 'emina';
                $loggedIn=true;
		          
                  $message = 'You have entered valid username and password';
echo "<script type='text/javascript'>alert('$message');</script>";
                  
               }else {
                 $message = 'You have entered invalid username or password';
echo "<script type='text/javascript'>alert('$message');</script>";
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
            </ul>

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
//$novosti=file("novosti.csv");
       $novosti= file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."novosti.csv"); 
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
                else if($brojac==2) {print "<h3>$celija</h3>"; }
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
         
           $novostidesno=file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."novostidesno.csv"); 
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
                else if($brojac==2) {print "<h3>$celija</h3>"; }
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
             print(" <form class='logoutforma' method='post'>
       <input type='submit' value='Logout' id='logoutbutton' name='logoutbutton' /> <br><br></form>       <p class='headline'>
                      <form method='post'>
                      <label for='headline'>Headline:</label>
                        <input name='headline' type=text class='news' placeholder='' id='headlinearea'/>
                    </p>
                    <p class='image'>
                        <label for='image'>Image link:
                            <br>
                        </label>
                        <input name='image' type=text class='image' id='imagearea' />
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
                    <input type='submit' onclick='addElement();' name='addnewsbutton' value='ADD NEWS' id='addnewsbutton' /> 
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