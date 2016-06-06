
<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) { }
function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];


      $servername = "localhost";
      $dbname = "eminawt";
      $username = "root";
      $password = "";
      $konekcija = new mysqli($servername, $username, $password,$dbname);

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data);
         break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data);
         break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data);
        $username = $_GET["username"];
        $brojObavijesti = $_GET["brojObavijesti"];



    $upit ="SELECT o.* from obavijest o, korisnik k
 where o.Autor_id = k.id AND k.username = '$username' limit $brojObavijesti";

    $result = $konekcija->query($upit);


    //$podaci = $result->fetchAll;

    print json_encode($result);

    $myArray = array();
     if ($result->num_rows > 0) {

        while($row = $result->fetch_array(MYSQL_ASSOC)) {
                $myArray[] = $row;
        }
        print json_encode($myArray);
    }

    $result->close();



    $konekcija->close();

        break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>
