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
        //判斷餘額
        if($user["balance"] >= $_POST["money"]) {
            $insert = DB::$db->prepare("UPDATE `user` SET `balance` = :money WHERE `name` = :name");
            $money = $user["balance"] - $_POST["money"];
            $insert->bindParam(":money", $money);
            $insert->bindParam(":name", $_POST["name"]);
            $insert->execute();
            //insert Data
            $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `money`, `infoMoney`, `info`, `count`) VALUES (:name, :money, :infoMoney, :info, :count)");
            $info = "轉出:";
            $count = $_POST["money"];
            $insertData->bindParam(":name", $user["name"]);
            $insertData->bindParam(":infoMoney", $money);
            $insertData->bindParam(":money", $user["balance"]);
            $insertData->bindParam(":info", $info);
            $insertData->bindParam(":count", $count);
            $insertData->execute();

            echo "<script> alert('成功轉出" . $_POST["money"] . "元'); location.href='bank.php'</script>";
        } else {
            echo "<script> alert('餘額不足') </script>";
        }

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
        <form  align="center"  method="post" action="Export.php">
            <input type="text" name="name"/>使用者ID
            <br>
            <input type="number" min="0" step="1" name="money"/>轉出金額
            <br>
            <input type="submit" name="btnImport" value="轉出"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>