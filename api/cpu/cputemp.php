<?php
$cputemp0 = `/usr/bin/sensors | grep 'Core 0:' | awk '{print $3}' | tr -d "+"`;
$cputemp1 = `/usr/bin/sensors | grep 'Core 1:' | awk '{print $3}' | tr -d "+"`;

$res[0] = (double)$cputemp0;
$res[1] = (double)$cputemp1;
$avg = ($res[0] + $res[1]) / 2;

echo json_encode(array("core1"=>$res[0], "core2"=>$res[1],"avg"=>$avg ));

?>
