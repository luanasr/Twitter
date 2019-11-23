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
					   <a href=editatweet.php?acao=editar=S&id_tweet='.$tweet> Editar </a>
					  
					   </td>
			</tr>";
			/*echo '<ul class="list-group "> ';
			echo '<h4 class="list-group-item-heading">'.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
			echo '<li class="list-group-item d-flex justify-content-between"> <p class="p-0 m-0 flex-grow-1">'.$registro['tweet'].' </p> 
			  <button type="button" method="GET" class="btn btn-outline-success ">
				   <td><a href="editatweet.php?id_tweet=<?php echo $registro[id_tweet]; ?>" style="color:inherit">EDITAR</button>
			</li>' ;
			echo '<div class="clearfix"></div>';

			echo '</ul>';
		echo '</a>';*/
	}
			} else {
			echo 'Erro na consulta de tweets no banco de dados!';
		}
?> 