function AcquireImage(){
            var DWObject = Dynamsoft.WebTwainEnv.GetWebTwain('dwtcontrolContainer');
            DWObject.IfShowUI = false;
            DWObject.SelectSource();
            DWObject.OpenSource();
            DWObject.AcquireImage();
        }
function btnUpload_onclick(){
DWObject.HTTPUploadThroughPostEx(
            strHTTPServer,
            DWObject.CurrentImageIndexInBuffer,
            strActionPage,
            uploadfilename,
            strImageType );
}

<?php   
  $fileTempName = $_FILES['RemoteFile']['tmp_name'];    
  $fileSize = $_FILES['RemoteFile']['size'];
  $fileName = "UploadedImages\\".$_FILES['RemoteFile']['name'];
  
  if (file_exists($fileName)) 
    $fWriteHandle = fopen($fileName, 'w');
  else
    $fWriteHandle = fopen($fileName, 'w');
  $fReadHandle = fopen($fileTempName, 'rb');
  $fileContent = fread($fReadHandle, $fileSize);
  fwrite($fWriteHandle, $fileContent);
  fclose($fWriteHandle);
  echo "DWTBarcodeUploadSuccess:".$_FILES['RemoteFile']['name'];
?>

