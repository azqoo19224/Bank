<?php
require_once 'DB.php';
DB::pdoConnect();
if(isset($_POST["Import"])){
    //
    $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name");
    $select->bindParam(":name",$_POST["name"]);
    $select->execute();
    $balance =  $select->fetch(PDO::FETCH_ASSOC);
    //insert balance
    $insert = DB::$db->prepare("UPDATE `user` SET `balance` = :money WHERE `name` = :name");
    $money=$balance["balance"]+$_POST["moneyin"];
    $insert->bindParam(":money",$money);
    $insert->bindParam(":name",$_POST["name"]);
    $insert->execute();
    //insert Data
    $insertData = DB::$db->prepare("INSERT INTO `data` (`id`, `name`, `money`, `project`) VALUES (:id, :name, :money, :project)");
    $project="使用者:".$balance["name"]."<br>轉入前的金錢為:".$balance["balance"]."<br>轉入後的金錢為:".$money;
    $insertData->bindParam(":id",$balance["id"]);
    $insertData->bindParam(":name",$balance["name"]);
    $insertData->bindParam(":money",$balance["balance"]);
    $insertData->bindParam(":project",$project);
    $insertData->execute();
    
    echo "<script> alert('成功轉入".$_POST["moneyin"]."元'); location.href='bank.php'</script>";


}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <form  align="center"  method="post" action="Import.php">
            <input type="text" name="name"/>使用者ID
            <br>
            <input type="text" name="moneyin"/>轉入金額
            <br>
            <input type="submit" name="Import" value="轉入"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>