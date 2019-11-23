<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();

    $id_tweet = $_GET['id_tweet'];
    $tweet = $_GET['tweet'];

	$query = "SELECT * FROM tweet, usuarios WHERE id_tweet = '$id_tweet'";
    $resultado = mysqli_query($link, $query);
    
    echo "$resultado";

?>

<form action="editar_tweet.php" method="post">
	<input type="hidden" name="id_tweet" value="<?php echo $id_tweet;?>">
	<input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>">
    Tweet:<input type="text" name="tweet" value="<?php $resultado ;?>"><br>
    <input type="submit" onClick="return confirm('Deseja atualizar o tweet?');" name="Submit" value="Alterar" id="button-form" />
</form>

<?php
