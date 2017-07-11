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

        $classe= mysqli_query($conn,"SELECT * FROM classe ORDER BY id_classe");
        //$rs = mysql_query("SELECT idcontato, nome, email FROM contato ORDER BY idcontato");
   
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";//cabeçalho do arquivo
               $xml .= "<proj_ged> \n";
         
        while($reg = mysqli_fetch_object($classe)){
             $xml .= "\t<classe>\n";
             $xml .= "\t\t<id_classe>$reg->id_classe</id_classe>\n";
             $xml .= "\t\t<nome>$reg->nome</nome>\n";
             $xml .= "\t\t<cod_classe>$reg->cod_classe</cod_classe> \n";
             $xml .= "\t\t<subordinacao>$reg->subordinacao</subordinacao> \n";
             $xml .= "\t\t<ativada>$reg->ativada</ativada> \n";
             $xml .= "\t\t<desativada>$reg->desativada</desativada> \n";
             $xml .= "\t\t<reativada>$reg->reativada</reativada> \n";
             $xml .= "\t\t<alterada>$reg->alterada</alterada> \n";
             $xml .= "\t\t<deslocada>$reg->deslocada</deslocada> \n";
             $xml .= "\t\t<deletada>$reg->deletada</deletada> \n";
             $xml .= "\t\t<status_classe>$reg->status_classe</status_classe> \n";
             $xml .= "\t</classe>\n";
         }

         $subclasse= mysqli_query($conn,"SELECT * FROM subclasse ORDER BY id_subclasse");

         while($reg = mysqli_fetch_object($subclasse)){
             $xml .= "\t<subclasse>\n";
             $xml .= "\t\t<id_subclasse>$reg->id_subclasse</id_subclasse>\n";
             $xml .= "\t\t<nome_subclasse>$reg->nome_subclasse</nome_subclasse>\n";
             $xml .= "\t\t<cod_subclasse>$reg->cod_subclasse</cod_subclasse> \n";
             $xml .= "\t\t<id_classe>$reg->id_classe</id_classe>\n";
             $xml .= "\t</subclasse>\n";
         }

         $grupo= mysqli_query($conn,"SELECT * FROM grupo ORDER BY id_grupo");

         while($reg = mysqli_fetch_object($grupo)){
             $xml .= "\t<grupo>\n";
             $xml .= "\t\t<id_grupo>$reg->id_grupo</id_grupo>\n";
             $xml .= "\t\t<nome_grupo>$reg->nome_grupo</nome_grupo>\n";
             $xml .= "\t\t<cod_grupo>$reg->cod_grupo</cod_grupo> \n";
             $xml .= "\t\t<id_subclasse>$reg->id_subclasse</id_subclasse>\n";
             $xml .= "\t</grupo>n";
         }

         $subgrupo= mysqli_query($conn,"SELECT * FROM subgrupo ORDER BY id_subgrupo");

         while($reg = mysqli_fetch_object($subgrupo)){
             $xml .= "\t<subgrupo>\n";
             $xml .= "\t\t<id_subgrupo>$reg->id_subgrupo</id_subgrupo>\n";
             $xml .= "\t\t<nome_subgrupo>$reg->nome_subgrupo</nome_subgrupo>\n";
             $xml .= "\t\t<cod_subgrupo>$reg->cod_subgrupo</cod_subgrupo> \n";
             $xml .= "\t\t<id_grupo>$reg->id_grupo</id_grupo>\n";
             $xml .= "\t</subgrupo>\n";
         }

         $documento= mysqli_query($conn,"SELECT * FROM documento ORDER BY id_doc");

         while($reg = mysqli_fetch_object($documento)){
             $xml .= "\t<documento>\n";
             $xml .= "\t\t<id_doc>$reg->id_doc</id_doc>\n";
             $xml .= "\t\t<nome_doc>$reg->nome_doc</nome_doc>\n";
             $xml .= "\t\t<cod_doc>$reg->cod_doc</cod_doc> \n";
             $xml .= "\t\t<desc_doc>$reg->desc_doc</desc_doc> \n";
             $xml .= "\t\t<id_subgrupo>$reg->id_subgrupo</id_subgrupo>\n";
             $xml .= "\t</documento>\n";
         }

         $xml .= "</proj_ged>";
   
         $ponteiro = fopen('backupproj_ged.xml', 'w'); //cria um arquivo com o nome backup.xml
         fwrite($ponteiro, $xml); // salva conteúdo da variável $xml dentro do arquivo backup.xml
   
         $ponteiro = fclose($ponteiro); //fecha o arquivo

         echo "<script language='javascript' type='text/javascript'>alert('Arquivo Exportado com Sucesso!');window.location.href='index.php';</script>";
      }
 
?>
 
