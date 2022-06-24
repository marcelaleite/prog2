<?php
require_once('class/conexao.class.php');
$banco = Conexao::getInstance();
$con = $banco->getConexao();
$sql = "Select * from usuarios";
try{
  $stmt = $con->prepare($sql); // prepara o sql para exeutar
}catch (PDOException $e){
  echo 'Erro ao preparar: '.$e->getMessage();
}
$stmt->execute(); // executa a consulta
$itens = '';
while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
  $item = file_get_contents('items.html');
  $item = str_replace('{id}',$linha['id'],$item);
  $item = str_replace('{nome}',$linha['nome'],$item);
  $item = str_replace('{email}',$linha['email'],$item);
  $item = str_replace('{login}',$linha['login'],$item);
  $itens .= $item;
}
$lista = file_get_contents('listaUsuarios.html');
$lista = str_replace('{itens}',$itens,$lista);
print($lista);




?>
