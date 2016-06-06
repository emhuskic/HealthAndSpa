<?php 
	session_start();
	$statusna = "pocetak";

    $niz_novihKomentara = array();

	if(isset($_SESSION['loggedIn']))
	{
		$statusna = "logovan";
		 $servername = "localhost";
      $dbname = "eminawt";
      $username = "root";
      $password = "";
      $konekcija = new mysqli($servername, $username, $password,$dbname);

    	mysqli_real_query($konekcija, "set names utf8;");


          $usernameUsera=$_SESSION['username'];


            $sql= "SELECT  `id` 
            FROM  `korisnik` 
            WHERE  `Username` =  '$usernameUsera'";
            $result=$konekcija->query($sql);


            if ($result->num_rows > 0) {
               
                while($row = $result->fetch_assoc()) {
                    $korisnikovIDUsera= $row["id"];
                }
            }


     
	    $novosti = $konekcija->query("select Naslov, id, BrojKomentara from obavijest where Autor_id = '$korisnikovIDUsera';");
	     
	    if (!$novosti) 
	    {
	          $greska = $konekcija->errorInfo();
	          print "SQL greška: " . $greska[2];
	          exit();
     	}
     	else
     	{
     		
     		
     		$i = 0;

     		foreach ($novosti as $model)
     		{
     			if($model["BrojKomentara"] != 0)
     			{
     				$noviObjekat = new stdClass;
     				
     				$noviObjekat->ObjekatID = $model["id"];
     				$noviObjekat->Naziv = $model["Naslov"];
					$noviObjekat->BrojNovihKomentara = $model["BrojKomentara"];

     				//$noviObjekat = new { $model["ObjekatID"], $model["Naziv"], $model["BrojNovihKomentara"] };
     			 	$niz_novihKomentara[$i] = $noviObjekat;	
     			 	$i = $i + 1;
     			}
     		}
     		//return json_encode($niz_novihKomentara);
     	}
	}

	echo json_encode($niz_novihKomentara);
	//echo json_encode($arr);
	
?>