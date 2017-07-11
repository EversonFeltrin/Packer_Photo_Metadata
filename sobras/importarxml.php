<?php 
  //INICIO A SESSÃO
  session_start();



  //Testa conexão com BD
  $conn = mysqli_connect($_SESSION["host"],$_SESSION["root"],$_SESSION["pass"]); 
  mysqli_select_db($conn,$_SESSION["banco"]) or die( "Não foi possível conectar ao banco MySQL");
  if (!$conn) {
    echo "<script language='javascript' type='text/javascript'>alert('Não foi possível conectar ao banco MySQL.');window.location.href='index.php';</script>";
    
    exit;
  }
  else{

	if (file_exists('backupproj_ged.xml')) {
	    $xml=simplexml_load_file("backupproj_ged.xml") or die("Error: Cannot create object");
	    print_r($xml);
	} else {
	    exit('Falha ao abrir backupproj_ged.xml.');
	}

	
	$x = 0;
	foreach ($xml->classe as $classe ){
		
	   mysqli_query($conn,"INSERT INTO classe (nome,cod_classe,subordinacao,ativada,desativada,reativada,alterada,deslocada,deletada,status_classe) VALUES ('$classe->nome','$classe->cod_classe','$classe->subordinacao','$classe->ativada','$classe->desativada','$classe->reativada','$classe->alterada','$classe->deslocada','$classe->deletada','$classe->status_classe')");
	  
	   $x = 0;
	   if(mysqli_affected_rows($conn) != -1){
	       $x++;
	   }
	
	echo "$x classes importados com sucesso!";

	}
	
	$x = 0;
	foreach ($xml->subclasse as $subclasse){
		
	   mysqli_query($conn,"INSERT INTO subclasse (nome_subclasse,cod_subclasse,id_classe) VALUES  ('$subclasse->nome_subclasse','$subclasse->cod_subclasse','$subclasse->id_classe')");

	    if(mysqli_affected_rows($conn) != -1){
	       $x++;
	    }
	}
	echo "$x subclasses importados com sucesso!";
	
  }
?>

