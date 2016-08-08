<?php
require_once 'DB.php';

    
  

    if(isset($_POST["btnImport"])){
        header("location:/BankProject/Import.php");
        exit();
    }
    
    if(isset($_POST["btnExport"])){
         header("location:/BankProject/Export.php");
        exit();
        
    }
    
    if(isset($_POST["btnCheck"])){
        
    }
    
    if(isset($_POST["btnDetails"])){
    }
?>
