<?php
require_once 'DB.php';

DB::pdoConnect();

if (isset($_POST["btnImport"])) {

        $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name");
        $select->bindParam(":name", $_POST["name"]);
        $select->execute();
        $user = $select->fetch(PDO::FETCH_ASSOC);

        $update = DB::$db->prepare("UPDATE `user` SET `balance` = :money, `version` = `version` + 1 WHERE `name` = :name AND `version` = :version");
        $count = $user["balance"] + $_POST["money"];
        $update->bindParam(":money", $count);
        $update->bindParam(":name", $_POST["name"]);
        $update->bindParam(":version", $user['version']);
        $update->execute();

        if ($update->rowCount()) {
            $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `balance`, `newBalance`, `info`, `money`) VALUES (:name, :balance, :newBalance, :info, :money)");
            $info = "轉入:";
            $insertData->bindParam(":name", $user["name"]);
            $insertData->bindParam(":newBalance", $count);
            $insertData->bindParam(":balance", $user["balance"]);
            $insertData->bindParam(":info", $info);
            $insertData->bindParam(":money", $_POST["money"]);
            $insertData->execute();

            echo "<script> alert('成功轉入" . $_POST["money"] . "元'); location.href='bank.php'</script>";
        } else {
            echo "<script> alert('連線逾時 請重試'); location.href='bank.php'</script>";
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