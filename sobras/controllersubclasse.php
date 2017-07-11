<?php
	$codigo_classe = $_POST['codigo_classe'];
	$codigo_subclasse = $_POST['codigo_subclasse'];
	$nome_subclasse = $_POST['nome_subclasse'];
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
	    	$select = mysqli_query($conn,"SELECT cod_subclasse FROM subclasse WHERE cod_subclasse = '$codigo_subclasse'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_subclasse'];
			
			

			if($logarray == $codigo_subclasse){ 
					echo"<script language='javascript' type='text/javascript'>alert('Essa subclasse já existe');window.location.href='index.php';</script>";
					die();

			}else{

					$classe = mysqli_query($conn,"SELECT id_classe FROM classe WHERE cod_classe = $codigo_classe");
					$id_classe = mysqli_fetch_array($classe);
					$aux_id_classe = $id_classe['id_classe'];					
					$insert = mysqli_query($conn,"INSERT INTO subclasse (nome_subclasse,cod_subclasse,id_classe) VALUES ('$nome_subclasse','$codigo_subclasse','$aux_id_classe')");
					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('SubClasse cadastrada com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar essa SubClasse');window.location.href='index.php'</script>";
					}
			}
	        break;
	    case 'Atualizar':
	    	$select = mysqli_query($conn,"SELECT * FROM subclasse WHERE cod_subclasse = '$codigo_subclasse'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_subclasse'];	
			$id_atualiza_sub = $array['id_subclasse'];
			
			if($logarray == $codigo_subclasse){ //erro apartir daqui

					$insert = mysqli_query($conn,"UPDATE subclasse  SET nome_subclasse = '$nome_subclasse' where id_subclasse = $id_atualiza_sub");

					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('SubClasse atualizada com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar essa subclasse');window.location.href='index.php'</script>";
					}

					
			}else{
					echo"<script language='javascript' type='text/javascript'>alert('Essa subclasse não está cadastrada.');window.location.href='index.php';</script>";
					die();			
			}
	        break;
	    case 'Deletar':
	        break;
	endswitch;
	
	mysqli_close($conn); 

?>