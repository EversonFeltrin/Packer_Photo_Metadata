<?php
	$codigo_subclasse = $_POST['codigo_subclasse'];
	$codigo_grupo = $_POST['codigo_grupo'];
	$nome_grupo = $_POST['nome_grupo'];
	$data=date('d/m/y');
	$opcao = $_POST['opcao'];

	//INICIO A SESSÃO
	session_start();
 
	//Testa conexão com BD
	$conn = mysqli_connect($_SESSION["host"],$_SESSION["root"],$_SESSION["pass"]); 
	mysqli_select_db($conn,$_SESSION["banco"]) or die( "Não foi possível conectar ao banco MySQL");
	if (!$conn) {
		echo "<script language='javascript' type='text/javascript'>alert('Não foi possível conectar ao banco MySQL.');window.location.href='cadastro.html';</script>";
		
		exit;
	}
    
 
 	switch ($opcao):
	    case 'Adicionar':
	    	$select = mysqli_query($conn,"SELECT cod_grupo FROM grupo WHERE cod_grupo = '$codigo_grupo'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_grupo'];
			
			

			if($logarray == $codigo_grupo){ 
					echo"<script language='javascript' type='text/javascript'>alert('Esse Grupo já existe');window.location.href='index.php';</script>";
					die();

			}else{

					$subclasse = mysqli_query($conn,"SELECT id_subclasse FROM subclasse WHERE cod_subclasse = $codigo_subclasse");
					$id_subclasse = mysqli_fetch_array($subclasse);
					$aux_id_subclasse = $id_subclasse['id_subclasse'];					
					$insert = mysqli_query($conn,"INSERT INTO grupo (nome_grupo,cod_grupo,id_subclasse) VALUES ('$nome_grupo','$codigo_grupo','$aux_id_subclasse')");
					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Grupo cadastrado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse Grupo');window.location.href='index.php'</script>";
					}
			}
	        break;
	    case 'Atualizar':
	    	$select = mysqli_query($conn,"SELECT * FROM grupo WHERE cod_grupo = '$codigo_grupo'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_grupo'];	
			$id_atualiza_grupo = $array['id_grupo'];
			
			if($logarray == $codigo_grupo){ //erro apartir daqui

					$insert = mysqli_query($conn,"UPDATE grupo  SET nome_grupo = '$nome_grupo' where id_grupo = $id_atualiza_grupo");

					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Grupo atualizado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse grupo');window.location.href='index.php'</script>";
					}

					
			}else{
					echo"<script language='javascript' type='text/javascript'>alert('Esse Grupo não está cadastrada.');window.location.href='index.php';</script>";
					die();			
			}
	        break;
	    case 'Deletar':
	        break;
	endswitch;
	
	mysqli_close($conn); 

?>