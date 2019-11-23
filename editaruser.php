<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$query = "SELECT * FROM usuarios WHERE usuario = '$_SESSION[usuario]'";
	$resultado = mysqli_query($link, $query);

	while($dados = $resultado->fetch_assoc()){
		$id = $dados['id'];
		$usuario = $dados['usuario'];
		$email = $dados['email'];
		$senha = $dados['senha'];
	}
?>

<form action="edita_usuario.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id;?>">
    Nome:<input type="text" name="usuario" value="<?php echo $usuario;?>"><br>
	Email:<input type="email" name="email" value="<?php echo $email;?>"><br>
	Senha:<input type="password" name="senha"><br>
    <input type="submit" onClick="return confirm('Deseja atualizar o usuario?');" name="Submit" value="Alterar" id="button-form" />
</form>