<?php
namespace myProject\Test;

use myProject\TestClass;

require dirname(dirname(dirname(dirname(__FILE__)))) . "/Controller.php";

class SetupTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExportSuccess()
    {
        $money = 123;
        $name = 'steve';
        $returnEcho = "<script> alert('成功轉出" . $money . "元'); location.href='bank.php'</script>";

        $return = getExport($money, $name);
        $this->assertEquals($returnEcho, $return);
    }

    public function testGetExportError()
    {
        $money = 111111111;
        $name = 'max';
        $returnEcho = "<script> alert('餘額不足') </script>";

        $return = getExport($money, $name);
        $this->assertEquals($returnEcho, $return);
    }

    public function testGetImportSuccess()
    {
        $money = 1;
        $name = 'max';
        $returnEcho = "<script> alert('成功轉入" . $money . "元'); location.href='bank.php'</script>";

        $return = getImport($money, $name);
        $this->assertEquals($returnEcho, $return);
    }

}
