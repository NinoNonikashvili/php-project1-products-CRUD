<?php


function randStr($length)
{
    $randomStr = '';
  $chars = '0123456789abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWQYZ';
  for($i=0; $i<$length; $i++){
    $index = random_int(0, strlen($chars)-1);
    $randomStr .= $chars[$index];
  }
 return $randomStr;
}


?>