<?php
$num_str = sprintf("%06d", mt_rand(10000, 999999));
header('Content-Type: application/json');
echo '{"code":0,"msg":"success","data":{"userId":"' . $num_str . '","handle":"' . $num_str . '","name":"' . $num_str . '","userDesc":"Users will use numbers as their name for now.","followNum":0,"likesNum":0,"verified":0,"fansNum":0,"musicalNum":0}}';