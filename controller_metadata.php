<?php
	
	//INICIO A SESSÃO
	session_start();
 
  $conn = mysqli_connect($_SESSION["host"],$_SESSION["root"],$_SESSION["pass"]); 
  mysqli_select_db($conn,$_SESSION["banco"]) or die( "Não foi possível conectar ao banco MySQL");
	if (!$conn) {
			echo "<script language='javascript' type='text/javascript'>alert('Não foi possível conectar ao banco MySQL.');window.location.href='../login.html';</script>";
			
			exit;
	}
  else{ 


		// Lista de tipos de arquivos permitidos
  	//$tiposPermitido = array('image/jpeg', 'image/pjpeg', 'image/png','image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');

    $titulo = $_POST['title'];
    $autor = $_POST['creator'];
    $assunto = $_POST['subject'];
    $descricao = $_POST['description'];
    $editor = $_POST['publisher'];
    $colaborador = $_POST['contributor'];
    $data = $_POST['date'];
    $tipo = $_POST['type'];
    $formato = $_POST['format'];
    $identificador = $_POST['identifier'];
    $fonte = $_POST['source'];
    $idioma = $_POST['language'];
    $relacao = $_POST['relation'];
    $abrangencia = $_POST['cobertura'];
    $direitos = $_POST['rights'];

		// O nome original do arquivo no computador do usuário
  		$arqName = $_FILES['arquivo']['name'];
  		// O tipo mime do arquivo. Um exemplo pode ser "image/gif"
  		$arqType = $_FILES['arquivo']['type'];
  		// O tamanho, em bytes, do arquivo
  		$arqSize = $_FILES['arquivo']['size'];
  		// O nome temporário do arquivo, como foi guardado no servidor
  		$arqTemp = $_FILES['arquivo']['tmp_name'];
  		// O código de erro associado a este upload de arquivo
  		$arqError = $_FILES['arquivo']['error'];

      /*echo $titulo."-".$autor."-".$assunto."-".$descricao."-".$editor."-".$colaborador."-".$data."-".$tipo."-".$formato."-".$identificador."-".$fonte."-".$idioma."-".$relacao."-".$abrangencia."-".$direitos;*/

      // Insira aqui a pasta que deseja salvar o arquivo
      $uploaddir = 'SIP/';
      $tiposPermitidos = array ('image/jpeg');
      if ($arqError == 0) {
        // Verifica o tipo de arquivo enviado
        if (array_search($arqType, $tiposPermitidos) === false) {
              echo 'O tipo de arquivo enviado é inválido!';
            // Não houveram erros, move o arquivo
        }
        else{

          $ext = explode('.',$arqName);
          $extensao = strtolower(end($ext));
          $nome = $data . '-' . $titulo . '.' . $extensao;
          $uploadfile = $uploaddir . $nome;
          echo "     ".$uploadfile;
          if (move_uploaded_file($arqTemp, $uploadfile)){
            echo"<script language='javascript' type='text/javascript'>alert('Arquivo enviado!');</script>";
          }
          else {
            echo"<script language='javascript' type='text/javascript'>alert('Arquivo não enviado!');</script>";
          }

          
          
          $insert = mysqli_query($conn,"INSERT INTO metadata(arquivo,titulo,autor,assunto,descricao,editor,colaborador,data,tipo,formato,identificador,fonte,idioma,relacao,abrangencia,direitos) VALUES ('$nome','$titulo','$autor','$assunto','$descricao','$editor','$colaborador','$data','$tipo','$formato','$identificador','$fonte','$idioma','$relacao','$abrangencia','$direitos');");
                
          if($insert == True){
            echo"<script language='javascript' type='text/javascript'>alert('Imagem cadastrada com sucesso!');window.location.href='packer.php'</script>";
          }else{
            echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar essa imagem.');window.location.href='packer.php'</script>";
          }
        }
  		}
      
    }  
	  	mysqli_close($conn); 
	


?>