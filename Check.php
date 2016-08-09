<?php
require_once 'DB.php';

DB::pdoConnect();

if ( isset($_POST["Check"])) {
    $select = DB::$db->prepare("SELECT `balance` FROM `user` WHERE `name` = :name");
    $select->bindParam(":name", $_POST["name"]);
    $select->execute();
    $balance =  $select->fetch(PDO::FETCH_ASSOC);
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
            <input type="submit" name="Check" value="查詢"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
        <?php if(isset($_POST["Check"])) { ?>
            <h2 align="center"> <?php echo "使用者:".$_POST["name"]."<br>餘額:".$balance["balance"]; ?> </h2>
        <?php } ?>
    </body>
</html>