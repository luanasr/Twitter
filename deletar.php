<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: index.php?erro=1');
}
require_once('db.class.php');
$objDb = new db();
$link = $objDb->conecta_mysql();

$query = "DELETE FROM usuarios WHERE email = '$_SESSION[email]'";
$resultado = mysqli_query($link, $query);

if(!$resultado){
    echo "erro ao deletar";
}else{
    echo "<input type='submit' onClick='return confirm(Deseja deletar o registro?);' name='Submit' value='Alterar' id='button-form' />";
    header("Location: index.php");
}

?>