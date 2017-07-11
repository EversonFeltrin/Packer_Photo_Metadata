<?php
	//INICIO A SESSÃO
	session_start();
 
	//Testa conexão com BD
	$host= 'localhost';
    $user_root = 'root';
    $user_senha = 'camilla2706';
    $banco = 'proj_ged';

    $_SESSION["host"] = $host;
    $_SESSION["root"] = $user_root;
    $_SESSION["pass"] = $user_senha;
    $_SESSION["banco"] = $banco;


    $conn = mysqli_connect($host,$user_root,$user_senha);
	mysqli_select_db($conn,$banco) or die( "Não foi possível conectar ao banco MySQL");
	if (!$conn) {
		echo "<script language='javascript' type='text/javascript'>alert('Não foi possível conectar ao banco MySQL.');window.location.href='index.html';</script>";		
		exit;
	}

?>


<!DOCTYPE html>
<html>

	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<!-- jQuery library -->
		<script src="js/jquery-3.0.0.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta charset="UTF-8">
		<title>.::Gerenciamento PCD::.</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>	
		
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	
	</head>
	
	
	<body>
	
		
		
		<div>
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand" href="#">SG_PCD</a>
				</div>
				<ul class="nav navbar-nav">
				  <li>
				  	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_classes" title="Cadastrar"><span class="glyphicon glyphicon-plus"> Classes</span></button>
				  </li>
				  <li>
				  	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_subclasses" title="Cadastrar"><span class="glyphicon glyphicon-plus"> SubClasses</span></button>
				  </li>
				  <li>
				  	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_grupos" title="Cadastrar"><span class="glyphicon glyphicon-plus"> Grupos</span></button>
				  </li>
				  <li>
				  	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_subgrupos" title="Cadastrar"><span class="glyphicon glyphicon-plus"> SubGrupos</span></button>
				  </li>
				  <li>
				  	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_documentos" title="Cadastrar"><span class="glyphicon glyphicon-plus"> Documentos</span></button>
				  </li>
				  <!--<li>
				  	<form action="subclasse.php" method="post">			    
					    <input type="text" name="cod_classe" id="cod_classe" placeholder="Código Documento" required>			    
					    <button type="submit" class="btn btn-info btn-md" title="Detalhar"><span class="glyphicon glyphicon-eye-open"> Detalhar Documento</span></button> 
					</form> 
				  </li>-->
				  <li>
					<!-- Trigger the modal with a button -->
					<a href="importarxml.php"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal_importar" title="Importar Arquivo"><span class="glyphicon glyphicon-import"> Importar XML</span></button></a>
				  </li> 
				  <li>
					<!-- Trigger the modal with a button -->
					<a href="exportarxml.php"><button type="button" class="btn btn-info btn-md"  title="Exportar Arquivo"><span class="glyphicon glyphicon-export"> Exportar XML</span></button></a>
				  </li>
				</ul>
			  </div>
			  
			</nav>

		</div>
		
		<!-- Modal  Cadastrar Classe-->
		<div id="myModal_classes" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Menu Classes</h4>
			  </div>
			  <div class="modal-body">
				<div class="container-fluid">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-6">
						<form class="form-horizontal" method="post" action="controllerclasse.php">
						  <div class="form-group">
							<label for="nome">Código da Classe</label>
							<input type="text" class="form-control" name="codigo_classe" id="codigo_classe" placeholder="Código" required>
							<label for="nome">Nome da Classe</label>
							<input type="text" class="form-control" name="nome_classe" id="nome_classe" placeholder="Nome" required>
						  </div>
						  <div class="form-group">
						  	  <label for="sel1">Select list:</label>
							  <select class="form-control" name="opcao" id="sel1">
							    <option>Adicionar</option>
							    <option>Atualizar</option>
							    <option>Deletar</option>
							  </select>
						  </div>
						  <div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary" name="cadastrar" id="cadastrar">Concluir</button>
						  </div>				  
						</form>
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>


		<!-- Modal  Atualizar Classe-->
		<div id="myModal_subclasses" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Menu SubClasses</h4>
			  </div>
			  <div class="modal-body">
				<div class="container-fluid">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-6">
						<form class="form-horizontal" method="post" action="controllersubclasse.php">
						  <div class="form-group">
						  	<label for="nome">Código da Classe Vinculada</label>
							<input type="text" class="form-control" name="codigo_classe" id="codigo_classe" placeholder="Informe a Classe para adicionar a SubClasse" required>
							<label for="nome">Código da SubClasse</label>
							<input type="text" class="form-control" name="codigo_subclasse" id="codigo_subclasse" placeholder="Código SubClasse" required>
							<label for="nome">Nome da SubClasse</label>
							<input type="text" class="form-control" name="nome_subclasse" id="nome_subclasse" placeholder="Nome da SubClasse " required>
						  </div>
						  <div class="form-group">
						  	  <label for="sel1">Select list:</label>
							  <select class="form-control" name="opcao" id="sel1">
							    <option>Adicionar</option>
							    <option>Atualizar</option>
							    <option>Deletar</option>
							  </select>
						  </div>
						  <div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary" name="atualizar" id="atualizar">Concluir</button>
						  </div>				  
						</form>
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>


		<!-- Modal  Excluir Classe-->
		<div id="myModal_grupos" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Menu Grupos</h4>
			  </div>
			  <div class="modal-body">
				<div class="container-fluid">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-6">
						<form class="form-horizontal" method="post" action="controllergrupo.php">
						  <div class="form-group">
						  	<label for="nome">Código da SubClasse Vinculada</label>
							<input type="text" class="form-control" name="codigo_subclasse" id="codigo_subclasse" placeholder="Informe a Classe para adicionar a SubClasse" required>
							<label for="nome">Código do Grupo</label>
							<input type="text" class="form-control" name="codigo_grupo" id="codigo_grupo" placeholder="Código do Grupo" required>
							<label for="nome">Nome do Grupo</label>
							<input type="text" class="form-control" name="nome_grupo" id="nome_grupo" placeholder="Nome do Grupo " required>
						  </div>
						  <div class="form-group">
						  	  <label for="sel1">Select list:</label>
							  <select class="form-control" name="opcao" id="sel1">
							    <option>Adicionar</option>
							    <option>Atualizar</option>
							    <option>Deletar</option>
							  </select>
						  </div>
						  <div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary" name="grupo" id="grupo">Concluir</button>
						  </div>				  
						</form>
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

				<!-- Modal  Excluir Classe-->
		<div id="myModal_subgrupos" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Menu SubGrupos</h4>
			  </div>
			  <div class="modal-body">
				<div class="container-fluid">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-6">
						<form class="form-horizontal" method="post" action="controllersubgrupo.php">
						  <div class="form-group">
						  	<label for="nome">Código do Grupo Vinculado</label>
							<input type="text" class="form-control" name="codigo_grupo" id="codigo_grupo" placeholder="Informe o Grupo para adicionar o SubGrupo" required>
							<label for="nome">Código do SubGrupo</label>
							<input type="text" class="form-control" name="codigo_subgrupo" id="codigo_subgrupo" placeholder="Código do Grupo" required>
							<label for="nome">Nome do SubGrupo</label>
							<input type="text" class="form-control" name="nome_subgrupo" id="nome_subgrupo" placeholder="Nome do Grupo " required>
						  </div>
						  <div class="form-group">
						  	  <label for="sel1">Select list:</label>
							  <select class="form-control" name="opcao" id="sel1">
							    <option>Adicionar</option>
							    <option>Atualizar</option>
							    <option>Deletar</option>
							  </select>
						  </div>
						  <div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary" name="subgrupo" id="subgrupo">Concluir</button>
						  </div>				  
						</form>
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

						<!-- Modal  Excluir Classe-->
		<div id="myModal_documentos" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Menu Documentos</h4>
			  </div>
			  <div class="modal-body">
				<div class="container-fluid">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-6">
						<form class="form-horizontal" method="post" action="controllerdocumento.php">
						  <div class="form-group">
						  	<label for="nome">Código do SubGrupo Vinculado</label>
							<input type="text" class="form-control" name="codigo_subgrupo" id="codigo_subgrupo" placeholder="Informe o SubGrupo para adicionar o Documento" required>
							<label for="nome">Código do Documento</label>
							<input type="text" class="form-control" name="codigo_documento" id="codigo_documento" placeholder="Código do Documento" required>
							<label for="nome">Nome do Documento</label>
							<input type="text" class="form-control" name="nome_documento" id="nome_documento" placeholder="Nome do Documento" required>
							<label for="nome">Descrição do Documento</label>
							<input type="text" class="form-control" name="descricao_documento" id="descricao_documento" placeholder="Descrição do Documento" required>
						  </div>
						  <div class="form-group">
						  	  <label for="sel1">Select list:</label>
							  <select class="form-control" name="opcao" id="sel1">
							    <option>Adicionar</option>
							    <option>Atualizar</option>
							    <option>Deletar</option>
							  </select>
						  </div>
						  <div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary" name="documento" id="documento">Concluir</button>
						  </div>				  
						</form>
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

		<div id="#classes" class="container">
				<div class="row">
					<?php
				
						$res = mysqli_query($conn,"select * from classe"); /*Executa o comando SQL, no caso para pegar todos os usuarios do sistema e retorna o valor da consulta em uma variavel ($res)  */
						if($res){

							echo "<table class='table table-hover'><tr class='cabecalho_table'><td>Classe</td><td>Status</td><td>Subclasse</td><td>Grupo</td><td>Subgrupo</td><td>Documento</td><td>Desrição Documento</td></tr>";			

							/*Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */
							while($escrever=mysqli_fetch_array($res)){
								//<tr><td>DATA</td><td>DESCRIÇÃO</td><td>RECEBIDO DE:</td><td>VALOR</td><td>CATEGORIA</td><td>COMPROVANTE</td></tr>
								/*Escreve cada linha da tabela*/
								echo "<tr><td>" . $escrever['cod_classe'] . " - " . $escrever['nome'] . "</td><td> ". $escrever['status_classe']."</td><td></td><td></td><td></td><td></td><td></td></tr>";
								

								$aux = $escrever['id_classe'];
								$sub = mysqli_query($conn,"select * from subclasse where id_classe = $aux");
								if($sub){
									while ($subclasse = mysqli_fetch_array($sub)){
										echo "<tr><td></td><td></td><td> ".$subclasse['cod_subclasse']." - ".$subclasse['nome_subclasse']."</td><td></td><td></td><td></td><td></td></tr>";
											$aux_sub = $subclasse['id_subclasse'];
											$gru = mysqli_query($conn,"select * from grupo where id_subclasse = $aux_sub");
											if($gru){
												while ($grupo = mysqli_fetch_array($gru)){
													echo "<tr><td></td><td></td><td></td><td>".$grupo['cod_grupo']." - ".$grupo['nome_grupo']."</td><td></td><td></td><td></td></tr>";

													$aux_gru = $grupo['id_grupo'];
													$sgru = mysqli_query($conn,"select * from subgrupo where id_grupo = $aux_gru");
													if($sgru){
														While ($subgrupo = mysqli_fetch_array($sgru)){
															echo "<tr><td></td><td></td><td></td><td></td><td>".$subgrupo['cod_subgrupo']." - ".$subgrupo['nome_subgrupo']."</td><td></td><td></td></tr>";	
															$aux_subgru = $subgrupo['id_subgrupo'];
															$doc = mysqli_query($conn,"select * from documento where id_subgrupo = $aux_subgru");
															if($doc){
																While ($documento = mysqli_fetch_array($doc)){
																	echo "<tr><td></td><td></td><td></td><td></td><td></td><td>".$documento['cod_doc']." - ".$documento['nome_doc']."</td><td>".$documento['desc_doc']."</td></tr>";
																}//fim whle $documento
															}//fim do if $doc
														}//fim while $subgrupo
													}//fim if $sgru
												}//fim do while $grupo
											}//fim do if $gru
									}//fim do while $subclasse
								}//fim do if $sub
							}//fim do while $escrever = classe
						
							echo "</table>"; /*fecha a tabela apos termino de impressão das linhas*/

							mysqli_close($conn);
						}//fim do if $res
						else{
							echo "Nenhuma Classe Encontrada!";
						}


					?>
				</div>
		</div>				
	</body>"
	

	

</html>