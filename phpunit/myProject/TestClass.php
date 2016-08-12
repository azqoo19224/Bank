<?php
namespace myProject;



class TestClass
{
    public function printStart($len){
        $result = "";
        for($i = 0; $i< $len; $i++){
            $result .= "*";
        }

        return $result;
    }
}