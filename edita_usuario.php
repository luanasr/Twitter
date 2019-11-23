<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');

	$id = $_POST['id'];
	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$query = "UPDATE usuarios SET usuario = '$usuario', email = '$email', senha = '$senha' WHERE email = '$_SESSION[email]'";
	$stmt = $link->prepare($query) or die($mysqli->error);
	if(mysqli_query($link, $query)){
		$stmt->bind_param('ssi', $nome, $email, $id);
		$stmt->execute();
		header("Location: home.php#tabs-4");
	}else{
		echo 'Erro ao alterar tweet.';
	}