<?php
require_once 'DB.php';

    DB::pdoConnect();
  

    if(isset($_POST["btnImport"])){
        // $a=DB::$db->prepare("INSERT INTO `user` (`id`) VALUES (1) ");
        // $a->execute();
    }
    
    if(isset($_POST["btnExport"])){
        
    }
    
    if(isset($_POST["btnCheck"])){
        
    }
    
    if(isset($_POST["btnDetails"])){
    }
?>