<?php
require_once 'DB.php';

DB::pdoConnect();

if (isset($_POST["btnCheck"])) {
    $select = DB::$db->prepare("SELECT `balance` FROM `user` WHERE `name` = :name");
    $select->bindParam(":name", $_POST["name"]);
    $select->execute();
    $balance = $select->fetch(PDO::FETCH_ASSOC);
    echo "使用者:" . $_POST["name"] . "<br>";
    echo "餘額:" . $balance["balance"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form  align="center"  method="post" action="Check.php">
            <input type="text" name="name"/>使用者ID
            <input type="submit" name="btnCheck" value="查詢"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>