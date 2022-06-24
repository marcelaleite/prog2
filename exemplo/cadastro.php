<?php
require_once('class/conexao.class.php');

$banco = Conexao::getInstance();
$con = $banco->getConexao();
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  $id = $_GET['id'];
  $sql = "select * from usuarios where id = :id";
  try{
    $stmt = $con->prepare($sql);
  }catch (PDOException $e){
    echo 'Erro ao preparar: '.$e->getMessage();
  }
  $stmt->bindParam(':id',$id);
  try{
    $stmt->execute();
  }catch (PDOException $e){
    echo 'Erro ao atualizar: '.$e->getMessage();
  }
  $dados = $stmt->fetchAll();
  $formulario = file_get_contents('formulario.html');
  $formulario = str_replace('{id}',$dados[0]['id'],$formulario);
  $formulario = str_replace('{nome}',$dados[0]['nome'],$formulario);
  $formulario = str_replace('{email}',$dados[0]['email'],$formulario);
  print($formulario);

}else{
  if (isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sql = "update usuarios
               set nome = :nome,
                  email = :email
    where id = :id";
    try{
      $stmt = $con->prepare($sql);
    }catch (PDOException $e){
      echo 'Erro ao preparar: '.$e->getMessage();
    }
    $stmt->bindParam(':nome',$nome);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':id',$id);
    try{
      $stmt->execute();
    }catch (PDOException $e){
      echo 'Erro ao atualizar: '.$e->getMessage();
    }
  }
}
 ?>
