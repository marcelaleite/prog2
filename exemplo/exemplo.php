<?php
require_once('class/conexao.class.php');

$banco = Conexao::getInstance('carolina');
echo($banco->valor);

$banco2 = Conexao::getInstance('marcela');
echo($banco2->valor);

$banco3 = Conexao::getInstance('bruno');
echo($banco3->valor);
 ?>
