<?php
	$codigo_subgrupo = $_POST['codigo_subgrupo'];
	$codigo_documento = $_POST['codigo_documento'];
	$nome_documento = $_POST['nome_documento'];
	$descricao_documento = $_POST['descricao_documento'];
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
	    	$select = mysqli_query($conn,"SELECT cod_doc FROM documento WHERE cod_doc = '$codigo_documento'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_doc'];
			
			

			if($logarray == $codigo_documento){ 
					echo"<script language='javascript' type='text/javascript'>alert('Esse Documento já existe');window.location.href='index.php';</script>";
					die();

			}else{

					$sgrupo = mysqli_query($conn,"SELECT id_subgrupo FROM subgrupo WHERE cod_subgrupo = $codigo_subgrupo");
					$id_subgrupo = mysqli_fetch_array($sgrupo);
					$aux_id_subgrupo = $id_subgrupo['id_subgrupo'];					
					$insert = mysqli_query($conn,"INSERT INTO documento (nome_doc,cod_doc,desc_doc,id_subgrupo) VALUES ('$nome_documento','$codigo_documento','$descricao_documento','$aux_id_subgrupo')");
					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Documento cadastrado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse Documento');window.location.href='index.php'</script>";
					}
			}
	        break;
	    case 'Atualizar':
	    	$select = mysqli_query($conn,"SELECT * FROM documento WHERE cod_doc = '$codigo_documento'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_doc'];	
			$id_atualiza_documento = $array['id_doc'];
			
			if($logarray == $codigo_documento){ //erro apartir daqui

					$insert = mysqli_query($conn,"UPDATE documento  SET nome_doc = '$nome_documento', desc_doc = '$descricao_documento' where id_doc = $id_atualiza_documento");

					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Documento atualizado com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse Documento');window.location.href='index.php'</script>";
					}

					
			}else{
					echo"<script language='javascript' type='text/javascript'>alert('Esse Documento não está cadastrada.');window.location.href='index.php';</script>";
					die();			
			}
	        break;
	    case 'Deletar':
	        break;
	endswitch;
	
	mysqli_close($conn); 

?>