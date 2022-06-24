<?php
require_once('class/conexao.class.php');


$banco = Conexao::getInstance();
$con = $banco->getConexao();

if ($_SERVER['REQUEST_METHOD'] ==  'GET'){
  // apresentar o formulário
  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "Select * from usuarios where id = :id";
    try{
      $stmt = $con->prepare($sql); // prepara o sql para exeutar
    }catch (PDOException $e){
      echo 'Erro ao preparar: '.$e->getMessage();
    }
    $stmt->bindParam(':id',$id); // vincula parâmetros
    $stmt->execute(); // executa a consulta
    $usuario = $stmt->fetchAll();

    //preencher o formulário
    $formulario = file_get_contents('formularioUsuario.html');

    $formulario = str_replace('{nome}',$usuario[0]['nome'],$formulario);
    $formulario = str_replace('{email}',$usuario[0]['email'],$formulario);
    $formulario = str_replace('{id}',$usuario[0]['id'],$formulario);

    print($formulario);
  }
}else if($_SERVER['REQUEST_METHOD'] ==  'POST'){
  if (isset($_POST['id'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sql = "update usuarios set nome = :nome,
                               email = :email
             where id = :id";
    try{
      $stmt = $con->prepare($sql); // prepara o sql para exeutar
    }catch (PDOException $e){
      echo 'Erro ao preparar: '.$e->getMessage();
    }
    $stmt->bindParam(':id',$id); // vincula parâmetros
    $stmt->bindParam(':nome',$nome); // vincula parâmetros
    $stmt->bindParam(':email',$email); // vincula parâmetros
    $stmt->execute(); // executa a consulta
  }
}


 ?>
