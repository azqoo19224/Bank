<?php
require_once 'DB.php';
DB::pdoConnect();
if(isset($_POST["Import"])){
  
    $select = DB::$db->prepare("SELECT `balance` FROM `user` WHERE `name` = :name");
    $select->bindParam(":name",$_POST["name"]);
    $select->execute();
    $balance =  $select->fetch(PDO::FETCH_ASSOC);
    $insert = DB::$db->prepare("UPDATE `user` SET `balance` = :money WHERE `name` = :name");
    if($balance["balance"]>=$_POST["moneyin"]){
        $money=$balance["balance"]-$_POST["moneyin"];
        $insert->bindParam(":money",$money);
        $insert->bindParam(":name",$_POST["name"]);
        $insert->execute();
        echo "<script> alert('成功轉出".$_POST["moneyin"]."元'); location.href='bank.php'</script>";
    } else{
        echo "<script> alert('餘額不足') </script>";
    }
   

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <form  align="center"  method="post" action="Export.php">
            <input type="text" name="name"/>使用者ID
            <br>
            <input type="text" name="moneyin"/>轉出金額
            <br>
            <input type="submit" name="Import" value="轉出"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>