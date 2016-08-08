<?php
require_once 'DB.php';

    DB::pdoConnect();
  

    if(isset($_POST["btnImport"])){
        header("location:/BankProject/Import.php");
        exit();
    }
    
    if(isset($_POST["btnExport"])){
        
    }
    
    if(isset($_POST["btnCheck"])){
        
    }
    
    if(isset($_POST["btnDetails"])){
    }
?>
