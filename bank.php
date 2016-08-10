<?php
require_once 'DB.php';

if(isset($_POST["btnImport"])) {
    header("location:/BankProject/Import.php");
    exit();
}

if(isset($_POST["btnExport"])) {
    header("location:/BankProject/Export.php");
    exit();
}

if(isset($_POST["btnCheck"])) {
    header("location:/BankProject/Check.php");
    exit();
}

if(isset($_POST["btnDetails"])) {
    header("location:/BankProject/Details.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <div>
        <form  method="post" action="bank.php">
            <table style="text-align:center;margin:0 auto;">
                <tr>
                    <td>
                        <h1>
                            使用者你好
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="btnImport" value="匯入"/>
                        <input type="submit" name="btnExport" value="匯出" />
                        <input type="submit" name="btnCheck" value="查看餘額"/>
                        <input type="submit" name="btnDetails" value="帳目明細"/>
                    </td>
                </tr>
            </table>
        </form>
</body>
</html>