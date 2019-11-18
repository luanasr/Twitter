<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario ";
	$sql.= " FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
	$sql.= " WHERE id_usuario = $id_usuario ";
	$sql.= " OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario = $id_usuario) ";
	$sql.= " ORDER BY data_inclusao DESC ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		echo "<table border='0'>";

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
				
			$usuario = $registro['usuario'];
			$data_inclusao_formatada = $registro['data_inclusao_formatada'];
			$tweet = $registro['tweet'];
		//	$id - $registro['id_usuario'];

		// NÃO FUNCIONA NADA 
		
			echo "<tr>
					   <td>$usuario</td>
					   <td>$data_inclusao_formatada</td> 
					   <td>$tweet</td>
					   <td>
					   <input type='button' onclick= 'inscrevase.php' value='Editar'>
					   </td>
			</tr>";
/*
				echo '<a class="list-group-item">';
				echo '<h4 class="list-group-item-heading">'.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
				echo '<li class="list-group-item-text">'.$registro['tweet'].'</li>';
				echo '<class="list-group-item">'. 

				
		'</li>';
				// echo < a href="#" class="list-group-item list-group-item-action">Editar </a> 
					
				//"<a href= editar.php id=? img src='../imagens/fav.png' >" funciona mas transforma linha td em editavel
				// "<a href='editar.php? id=?". $registro['usuario']. "> Editar </a>";
				//	"<img src='../imagens/fav.png'>";  

		 '</a>'; 
*/
		}
		
   echo "</table>";
	

	} else {
		echo 'Erro na consulta de tweets no banco de dados!';
	}

?>