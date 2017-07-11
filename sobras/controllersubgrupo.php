<?php
	$codigo_grupo = $_POST['codigo_grupo'];
	$codigo_subgrupo = $_POST['codigo_subgrupo'];
	$nome_subgrupo = $_POST['nome_subgrupo'];
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
	    	$select = mysqli_query($conn,"SELECT cod_subgrupo FROM subgrupo WHERE cod_subgrupo = '$codigo_subgrupo'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_subgrupo'];
			
			

			if($logarray == $codigo_subgrupo){ 
					echo"<script language='javascript' type='text/javascript'>alert('Esse SubGrupo já existe');window.location.href='index.php';</script>";
					die();

			}else{

					$grupo = mysqli_query($conn,"SELECT id_grupo FROM grupo WHERE cod_grupo = $codigo_grupo");
					$id_grupo = mysqli_fetch_array($grupo);
					$aux_id_grupo = $id_grupo['id_grupo'];					
					$insert = mysqli_query($conn,"INSERT INTO subgrupo (nome_subgrupo,cod_subgrupo,id_grupo) VALUES ('$nome_subgrupo','$codigo_subgrupo','$aux_id_grupo')");
					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('SubGrupo cadastrado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse SubGrupo');window.location.href='index.php'</script>";
					}
			}
	        break;
	    case 'Atualizar':
	    	$select = mysqli_query($conn,"SELECT * FROM subgrupo WHERE cod_subgrupo = '$codigo_subgrupo'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_subgrupo'];	
			$id_atualiza_subgrupo = $array['id_subgrupo'];
			
			if($logarray == $codigo_subgrupo){ //erro apartir daqui

					$insert = mysqli_query($conn,"UPDATE subgrupo  SET nome_subgrupo = '$nome_subgrupo' where id_subgrupo = $id_atualiza_subgrupo");

					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('SubGrupo atualizado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse SubGrupo');window.location.href='index.php'</script>";
					}

					
			}else{
					echo"<script language='javascript' type='text/javascript'>alert('Esse SubGrupo não está cadastrada.');window.location.href='index.php';</script>";
					die();			
			}
	        break;
	    case 'Deletar':
	        break;
	endswitch;
	
	mysqli_close($conn); 

?>