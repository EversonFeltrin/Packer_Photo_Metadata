<?php
	$codigo_classe = $_POST['codigo_classe'];
	$nome_classe = $_POST['nome_classe'];
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
	    	$select = mysqli_query($conn,"SELECT cod_classe FROM classe WHERE cod_classe = '$codigo_classe'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_classe'];
			if($logarray == $codigo_classe){ 
					echo"<script language='javascript' type='text/javascript'>alert('Essa Classe já existe');window.location.href='index.php';</script>";
					die();

			}else{
					
					$insert = mysqli_query($conn,"INSERT INTO classe (nome,cod_classe,subordinacao,ativada,desativada,reativada,alterada,deslocada,deletada,status_classe) VALUES ('$nome_classe','$codigo_classe','desconhecida','$data','$data','$data','$data','$data','$data','A')");
					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Classe cadastrada com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='index.php'</script>";
					}
			}
	        break;
	    case 'Atualizar':
	    	$select = mysqli_query($conn,"SELECT * FROM classe WHERE cod_classe = '$codigo_classe'");
			$array = mysqli_fetch_array($select);
			$logarray = $array['cod_classe'];
			$id_atualiza = $array['id_classe'];

			if($logarray == $codigo_classe){ 

					$insert = mysqli_query($conn,"UPDATE classe  SET nome = '$nome_classe', alterada = '$data' where id_classe = $id_atualiza");

					 
					if($insert){
						echo"<script language='javascript' type='text/javascript'>alert('Classe atualizada com sucesso!');window.location.href='index.php'</script>";
					}else{
						echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar essa classe');window.location.href='index.php'</script>";
					}

					
			}else{
					echo"<script language='javascript' type='text/javascript'>alert('Essa classe não está cadastrada.');window.location.href='index.php';</script>";
					die();			
			} 
	        break;
	    case 'Deletar':
	        break;
	endswitch;

	
	
	
	mysqli_close($conn); 

?>
