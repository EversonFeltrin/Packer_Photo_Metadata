<?php
	//INICIO A SESSÃO
	session_start();
 
	//Testa conexão com BD
	$host= 'localhost';
    $user_root = 'root';
    $user_senha = 'camilla2706';
    $banco = 'ged_sip';

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
	
	<header>
	</header>
	<body>
		<div class ="container corpo_packer">
			<div>
				<div class="row corpo_img">
						<div class="col-lg-5">						
						</div>
						<div class="col-lg-2 imagem">
							<img src="packer.png" alt="Smiley face" height="150" width="150">
						</div>
						<div class="col-lg-5">
						</div>
				</div>
			</div>
			<div>
				<div class="col-lg-6 subcorpo1">
					<div class="row corpo_texto_packer">
						<p class="paragrafo_inicio">Escolha a Imagem para Upload:</p>				
						<form class="form-horizontal" method="post"  action="controller_metadata.php" enctype="multipart/form-data">
						    <div class="form-group">
							  	<div class="form-group">
							  		<input type="file" name="arquivo" id="arquivo"/>
								</div>
								<div class="form-group">
									<input type="text" name="title" id="title" placeholder="Título" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="creator" id="creator" placeholder="Autor" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="subject" id="subject" placeholder="Assunto" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="description" id="description" placeholder="Descrição" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="publisher" id="publisher" placeholder="Editor" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="contributor" id="contributor" placeholder="Colaborador" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="date" name="date" id="date" placeholder="Data (AAAA-MM-DD)" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="type" id="type" placeholder="Tipo" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="format" id="format" placeholder="Formato" class="form-control ajuste_box"/>			
								</div>
								<div class="form-group">	
									<input type="text" name="identifier" id="identifier" placeholder="Identificador do Recurso" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="source" id="source" placeholder="Fonte" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="language" id="language" placeholder="Idioma" class="form-control ajuste_box" required/>
								</div>
								<div class="form-group">
									<input type="text" name="relation" id="relation" placeholder="Relação" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="cobertura" id="cobertura" placeholder="Abrangência" class="form-control ajuste_box"/>
								</div>
								<div class="form-group">
									<input type="text" name="rights" id="rights" placeholder="Direitos Autorais" class="form-control ajuste_box" required/>
								</div>
		   	        		</div>
							<div class="form-group">
								<div class="col-lg-4">
								</div>
								<div class="col-lg-4">
							    	<button type="submit" class="btn btn-lg btn-listar glyphicon glyphicon-camera botao" name="packer" id="packer">   Adicionar Imagem</button>
							    </div>
							    <div class="col-lg-4">
								</div>
							</div>				  
						</form>		
					</div>							
				</div>
				<div class="col-lg-6 subcorpo2">
					<div class="row form_img">
						<p class="paragrafo_inicio">Imagens enviadas ao sistema:</p>
						<?php
					
							$res = mysqli_query($conn,"select * from metadata"); /*Executa o comando SQL, no caso para pegar todos os usuarios do sistema e retorna o valor da consulta em uma variavel ($res)  */
							if($res){

								echo "<table class='table table-hover'><tr class='cabecalho_table'><td>Título</td><td>Autor</td><td>Assunto</td></tr>";			

								/*Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */
								while($escrever=mysqli_fetch_array($res)){
									//<tr><td>DATA</td><td>DESCRIÇÃO</td><td>RECEBIDO DE:</td><td>VALOR</td><td>CATEGORIA</td><td>COMPROVANTE</td></tr>
									/*Escreve cada linha da tabela*/
									echo "<tr><td>" . $escrever['titulo'] ."</td><td> ". $escrever['autor']."</td><td> ". $escrever['assunto']."</td></tr>";
								}
								echo "</table>"; /*fecha a tabela apos termino de impressão das linhas*/

								mysqli_close($conn);
							}//fim do if $res
							else{
								echo "Nenhuma Classe Encontrada!";
							}
						?>
					</div>
					<div class="row empac_img">
						<div class="col-lg-4">
						</div>
						<div class="col-lg-4">
						   	<a href="importar_metadata.php"><button type="submit" class="btn btn-lg btn-listar glyphicon glyphicon-export" name="packer" id="packer">   Empacotar Imagem</button></a>
						</div>
						<div class="col-lg-4">
						</div>
					</div>
						
				</div>
			</div>	
		</div>
	</body>
	<footer>
	</footer>	
</html>