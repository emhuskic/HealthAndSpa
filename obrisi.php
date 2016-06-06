<?php 

	
	 $servername = "localhost";
      $dbname = "eminawt";
      $username = "root";
      $password = "";
      $konekcija = new mysqli($servername, $username, $password,$dbname);


	$id=$_REQUEST["id"];

	  $sql="DELETE from korisnik where id='$id'";

      if ($konekcija->query($sql) === TRUE) {
          
           header("location: admin.php");
          
        }



?>