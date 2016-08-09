<?php
require_once 'DB.php';
DB::pdoConnect();
if(isset($_POST["Details"])){
    $select = DB::$db->prepare("SELECT * FROM `data` WHERE `name` = :name");
    $select->bindParam(":name", $_POST["name"]);
    $select->execute();
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
            <input type="submit" name="Details" value="查詢"/>
            <input type="button" name="back" value="返回" onclick="location.href='bank.php'"/>
        </form>
        <?php if(isset($_POST["Details"])){
                while($result =  $select->fetch(PDO::FETCH_ASSOC)){ ?>
            <h2 align="center"> <?php echo $result["time"]."->".$result["project"]; ?> </h2>
        <?php       }
              } ?>
    </body>
</html>