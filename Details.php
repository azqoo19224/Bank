<?php
require_once 'DB.php';

DB::pdoConnect();

if (isset($_POST["btnDetails"])) {
    $select = DB::$db->prepare("SELECT * FROM `data` WHERE `name` = :name");
    $select->bindParam(":name", $_POST["name"]);
    $select->execute();
    $data = $select->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $result) {
        echo "時間:" . $result["time"] . "<br>";
        echo "使用者:" . $result["name"] . "<br>";
        echo "選擇操作為__" . $result["info"] . "__金額:" . $result['count'] . "<br>";
        echo "操作前的金錢為:" . $result["money"] . "<br>";
        echo "操作後的金錢為:" .  $result["infoMoney"] . "<br><br>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form  align="center"  method="post" action="Details.php">
            <input type="text" name="name"/>使用者ID
            <input type="submit" name="btnDetails" value="查詢"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
    </body>
</html>