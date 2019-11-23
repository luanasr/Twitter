<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];
    $id_tweet = $_GET['id_tweet'];
    $tweet = $_GET['tweet'];
	
	$objDb = new db();
    $link = $objDb->conecta_mysql();
    echo $resultado;

    $query = "UPDATE tweet SET tweet = '$tweet' WHERE id_usuario = '$_SESSION[id_usuario]' AND id_tweet = '$id_tweet'";
    echo $query;
	$stmt = $link->prepare($query) or die($mysqli->error);
	if(mysqli_query($link, $query)){
		$stmt->bind_param('i', $tweet);
		$stmt->execute();
		echo 'Tweet alterado com sucesso';
	}else{
		echo 'Erro ao alterar tweet.';
	}
