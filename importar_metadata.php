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
      

        $consulta= mysqli_query($conn,"SELECT * FROM metadata ORDER BY id_metadata");
        //$rs = mysql_query("SELECT idcontato, nome, email FROM contato ORDER BY idcontato");
   
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";//cabeçalho do arquivo
               $xml .= "<metadata> \n";
         
        while($data = mysqli_fetch_object($consulta)){
            $xml .= "\t<data>\n";
            $xml .= "\t\t<dc.filename>$data->arquivo</dc.filename>\n";
            $xml .= "\t\t<dc.title>$data->titulo</dc.title>\n";
            $xml .= "\t\t<dc.creator>$data->autor</dc.creator>\n";
            $xml .= "\t\t<dc.subject>$data->assunto</dc.subject>\n";
            $xml .= "\t\t<dc.description>$data->descricao</dc.description>\n";
            $xml .= "\t\t<dc.publisher>$data->editor</dc.publisher>\n";
            $xml .= "\t\t<dc.contributor>$data->colaborador</dc.contributor>\n";
            $xml .= "\t\t<dc.date>$data->data</dc.date>\n";
            $xml .= "\t\t<dc.type>$data->tipo</dc.type>\n";
            $xml .= "\t\t<dc.format>$data->formato</dc.format>\n";
            $xml .= "\t\t<dc.identifier>$data->identificador</dc.identifier>\n";
            $xml .= "\t\t<dc.source>$data->fonte</dc.source>\n";
            $xml .= "\t\t<dc.language>$data->idioma</dc.language>\n";
            $xml .= "\t\t<dc.relation>$data->relacao</dc.relation>\n";
            $xml .= "\t\t<dc.coverage>$data->abrangencia</dc.coverage>\n";
            $xml .= "\t\t<dc.rights>$data->direitos</dc.rights>\n";
            $xml .= "\t</data>\n";
         }

         $xml .= "</metadata>";
   
         $ponteiro = fopen('SIP/metadata/metadata.xml', 'w'); //cria um arquivo com o nome backup.xml
         fwrite($ponteiro, $xml); // salva conteúdo da variável $xml dentro do arquivo backup.xml
   
         $ponteiro = fclose($ponteiro); //fecha o arquivo

         echo "<script language='javascript' type='text/javascript'>alert('Arquivo Exportado com Sucesso!');window.location.href='packer.php';</script>";
      
 
?>