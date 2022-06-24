<?php
$x = 0;
$y = 10;

try{
  echo $y/$x;
}catch(Error $e){
  echo 'Divisão por zero não é válida';
}

 ?>
