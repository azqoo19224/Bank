<?php
require_once 'DB.php';

DB::pdoConnect();

if (isset($_POST["btnImport"])) {
    try {
        DB::$db->beginTransaction();

        $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name FOR UPDATE");
        $select->bindParam(":name", $_POST["name"]);
        $select->execute();
        $user = $select->fetch(PDO::FETCH_ASSOC);

        $update = DB::$db->prepare("UPDATE `user` SET `balance` = :money WHERE `name` = :name");
        $count = $user["balance"] + $_POST["money"];
        $update->bindParam(":money", $count);
        $update->bindParam(":name", $_POST["name"]);
        $update->execute();

        $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `balance`, `newBalance`, `info`, `money`) VALUES (:name, :balance, :newBalance, :info, :money)");
        $info = "轉入:";
        $insertData->bindParam(":name", $user["name"]);
        $insertData->bindParam(":newBalance", $count);
        $insertData->bindParam(":balance", $user["balance"]);
        $insertData->bindParam(":info", $info);
        $insertData->bindParam(":money", $_POST["money"]);
        $insertData->execute();

        DB::$db->commit();
        DB::$db = null;

        echo "<script> alert('成功轉入" . $_POST["money"] . "元'); location.href='bank.php'</script>";
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