<?php
require_once 'DB.php';

DB::pdoConnect();

function getExport($money, $name)
{
    $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name");
    $select->bindParam(":name", $name);
    $select->execute();
    $user = $select->fetch(PDO::FETCH_ASSOC);

    if ($user["balance"] >= $money) {
        $update = DB::$db->prepare("UPDATE `user` SET `balance` = :money, `version` = `version` + 1 WHERE `name` = :name AND `version` = :version");
        $count = $user["balance"] - $_POST["money"];
        $update->bindParam(":money", $count);
        $update->bindParam(":name",$name);
        $update->bindParam(":version", $user['version']);
        $update->execute();

        if ($update->rowCount()) {
            $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `balance`, `newBalance`, `info`, `money`) VALUES (:name, :balance, :newBalance, :info, :money)");
            $info = "轉出:";
            $insertData->bindParam(":name", $user["name"]);
            $insertData->bindParam(":newBalance", $count);
            $insertData->bindParam(":balance", $user["balance"]);
            $insertData->bindParam(":info", $info);
            $insertData->bindParam(":money", $_POST["money"]);
            $insertData->execute();

            return "<script> alert('成功轉出" . $money . "元'); location.href='bank.php'</script>";
        } else {
            return "<script> alert('連線逾時 請重試') </script>";
        }
    } else {
        return "<script> alert('餘額不足') </script>";
    }
}

function getImport($money, $name)
{
    $select = DB::$db->prepare("SELECT * FROM `user` WHERE `name` = :name");
    $select->bindParam(":name", $name);
    $select->execute();
    $user = $select->fetch(PDO::FETCH_ASSOC);

    $update = DB::$db->prepare("UPDATE `user` SET `balance` = :money, `version` = `version` + 1 WHERE `name` = :name AND `version` = :version");
    $count = $user["balance"] + $money;
    $update->bindParam(":money", $count);
    $update->bindParam(":name", $name);
    $update->bindParam(":version", $user['version']);
    $update->execute();

    if ($update->rowCount()) {
        $insertData = DB::$db->prepare("INSERT INTO `data` (`name`, `balance`, `newBalance`, `info`, `money`) VALUES (:name, :balance, :newBalance, :info, :money)");
        $info = "轉入:";
        $insertData->bindParam(":name", $name);
        $insertData->bindParam(":newBalance", $count);
        $insertData->bindParam(":balance", $user["balance"]);
        $insertData->bindParam(":info", $info);
        $insertData->bindParam(":money", $money);
        $insertData->execute();

        return "<script> alert('成功轉入" . $money . "元'); location.href='bank.php'</script>";
    } else {
        return "<script> alert('連線逾時 請重試'); location.href='bank.php'</script>";
    }
}
