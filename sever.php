<?php
require_once 'DB.php';

if( isset($_POST["btnImport"])) {
    header("location:/BankProject/Import.php");
    exit();
}

if( isset($_POST["btnExport"])) {
    header("location:/BankProject/Export.php");
    exit();
    
}

if( isset($_POST["btnCheck"])) {
    header("location:/BankProject/Check.php");
    exit();
}

if( isset($_POST["btnDetails"])) {
    header("location:/BankProject/Details.php");
    exit();
}

