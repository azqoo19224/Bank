<?php
require_once 'DB.php';

DB::pdoConnect();

if (isset($_POST["btnImport"])) {
    try {
	    DB::$db->beginTransaction();

        $info = "轉入:" . $_POST["money"];
        $money = $user["balance"] + $_POST["money"];

        // select user
        $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name FOR UPDATE");
        $select->bindParam(":name", $_POST["name"]);
        $select->execute();
        $user = $select->fetch(PDO::FETCH_ASSOC);
        // update balance
        $insert = DB::$db->prepare("UPDATE `user` SET `balance` = :money WHERE `name` = :name");
        $insert->bindParam(":money", $money);
        $insert->bindParam(":name", $_POST["name"]);
        $insert->execute();
        // insert data
        $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `money`, `infoMoney`, `info`) VALUES (:name, :money, :infoMoney, :info)");
        $insertData->bindParam(":name", $user["name"]);
        $insertData->bindParam(":infoMoney", $money);
        $insertData->bindParam(":money", $user["balance"]);
        $insertData->bindParam(":info", $info);
        $insertData->execute();

        echo "<script> alert('成功轉入" . $_POST["money"] . "元'); location.href='bank.php'</script>";

        DB::$db->commit();
	    DB::$db = NULL;

    } catch (PDOException $err) {
	    DB::$db->rollback();
	    echo "Error: " . $err->getMessage();
	    exit();
        }
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
            <input type="number" min="0" step="1" name="money"/>轉入金額
            <br>
            <input type="submit" name="btnImport" value="轉入"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>