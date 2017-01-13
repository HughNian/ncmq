<?php
set_time_limit(0);
header("Connection: Keep-Alive");
header("Proxy-Connection: Keep-Alive");

include "NcmqSocketModel.php";

$ncmqSocket = new NcmqSocketModel();
//$mqueue = $ncmqSocket->mqueue();
$queue = $ncmqSocket->dequeue('queue2');

echo $queue . "\r\n";