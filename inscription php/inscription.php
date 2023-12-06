-----------------------INSCRIPTION.PHP--------------
<?php
//include('connexion.php');

$host="localhost";
$user="root";
$password="";
$dbname="technoweb";
//$link=mysql_connect($host,$user,$password) or die ('impossible de se connceter');
//mysql_select_db($dbname,$link);


$mysqli = new mysqli($host,$user,"",$dbname);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$nomR=$_POST['nom'];
$prenomR=$_POST['prenom'];
$sexeR=$_POST['sexe'];
$classeR=$_POST['classe'];

$requete="insert into etudiant(nom,prenom,sexe,classe) values ('$nomR', '$prenomR', '$sexeR', '$classeR' );  ";
if(mysqli_query($mysqli,$requete))
echo 'insertion réussie<br> <a href="inscription.html"> Retour </a>';
else
echo 'insertion non réussie<br> <a href="inscription.html"> Retour </a>';

?>